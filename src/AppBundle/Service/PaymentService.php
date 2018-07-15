<?php

namespace AppBundle\Service;

use AppBundle\DTO\AbstractPaymentModel;
use AppBundle\DTO\Charge;
use AppBundle\DTO\Recurring;
use AppBundle\Entity\CardToken;
use AppBundle\Entity\Order;
use AppBundle\Entity\Product;
use AppBundle\Type\PaymentClickType;
use AppBundle\Type\PaymentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class PaymentService.
 */
class PaymentService
{
    /**
     * @var ValidatorInterface
     */
    public $validator;

    /**
     * @var FormFactoryInterface
     */
    public $formFactory;

    /**
     * @var SolidGateService
     */
    public $solidGateService;

    /**
     * @var EntityManagerInterface
     */
    public $em;

    /**
     * @var CountryService
     */
    public $countryService;

    /**
     * @var OrderService
     */
    public $orderService;

    /**
     * @param Request $request
     *
     * @return bool|\Symfony\Component\Form\FormInterface
     *
     * @throws \Exception
     */
    public function getForm(Request $request)
    {
        $form = $this->formFactory->create(PaymentType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $this->getOrder($request);
            $dto = $this->getChargeData($order, $form->getData());

            return $this->charge($dto, $order);
        }

        return $form;
    }

    /**
     * @param Request $request
     *
     * @return bool|\Symfony\Component\Form\FormInterface
     *
     * @throws \Exception
     */
    public function getFormOneClick(Request $request)
    {
        $form = $this->formFactory->create(PaymentClickType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $order = $this->getOrder($request);
            $dto = $this->getRecurringData($order, $form->getData());

            return $this->recurring($dto, $order);
        }

        return $form;
    }

    /**
     * @param Request $request
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     *
     * @throws \Exception
     */
    public function checkStatus(Request $request)
    {
        $order = $this->em->getRepository(Order::class)->findOneBy([
            'orderId' => $request->attributes->get('orderId'),
        ]);
        if (null === $order) {
            throw new NotFoundHttpException('Order not found');
        }
        $data = $this->solidGateService->status(['order_id' => $order->getOrderId()]);

        return $this->checkAndSaveOrderData($order, $data);
    }

    /**
     * @param ValidatorInterface $validator
     *
     * @required
     */
    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    /**
     * @param SolidGateService $solidGateService
     *
     * @required
     */
    public function setSolidGateService(SolidGateService $solidGateService): void
    {
        $this->solidGateService = $solidGateService;
    }

    /**
     * @param EntityManagerInterface $em
     *
     * @required
     */
    public function setEm(EntityManagerInterface $em): void
    {
        $this->em = $em;
    }

    /**
     * @param CountryService $countryService
     *
     * @required
     */
    public function setCountryService(CountryService $countryService): void
    {
        $this->countryService = $countryService;
    }

    /**
     * @param OrderService $orderService
     *
     * @required
     */
    public function setOrderService(OrderService $orderService): void
    {
        $this->orderService = $orderService;
    }

    /**
     * @param FormFactoryInterface $formFactory
     *
     * @required
     */
    public function setFormFactory(FormFactoryInterface $formFactory): void
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @param Order $order
     * @param array $data
     *
     * @return Recurring
     */
    public function getRecurringData(Order $order, array $data): Recurring
    {
        $dto = new Recurring();
        $dto->setRecurringToken($data['recurringToken']);
        $dto->setCustomerEmail($data['customerEmail']);
        $this->setOrderDataInDto($dto, $order);

        return $dto;
    }

    /**
     * @param Order $order
     * @param array $data
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function checkAndSaveOrderData(Order $order, array $data): bool
    {
        if (!empty($data['transactions']) && is_array($data['transactions'])) {
            $cardTokens = [];
            $tokens = [];
            foreach ($data['transactions'] as $transaction) {
                if (isset($transaction['card'], $transaction['card']['card_token'], $transaction['card']['card_token']['token'])) {
                    $cardSystemToken = $transaction['card']['card_token']['token'];
                    /** check on unique in current array of transactions */
                    if (in_array($cardSystemToken, $tokens)) {
                        continue;
                    }
                    $cardToken = new CardToken();
                    $cardToken->setToken($cardSystemToken);
                    $cardTokens[] = $cardToken;
                }
            }
            foreach ($cardTokens as $token) {
                if (0 === count($this->validator->validate($token))) {
                    $this->em->persist($token);
                }
            }
            $this->em->flush();
        }

        if (isset($data['order']['status'])) {
            $order->setStatus($data['order']['status']);
            $this->em->flush();

            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     *
     * @return Order
     */
    public function getOrder(Request $request): Order
    {
        $product = $this->em->getRepository(Product::class)->find($request->attributes->getInt('productId'));
        if (null === $product) {
            throw new NotFoundHttpException('Product nof found');
        }

        return $this->orderService->createOrder($product);
    }

    /**
     * @param Order $order
     * @param array $data
     *
     * @return Charge
     */
    public function getChargeData(Order $order, array $data): Charge
    {
        $dto = new Charge();
        $dto->setCardCvv($data['cardCvv'] ?? null);
        $dto->setCardNumber($data['cardNumber'] ?? null);
        $dto->setCardExpYear($data['cardExpYear'] ?? null);
        $dto->setCardExpMonth($data['cardExpMonth'] ?? null);
        $dto->setCardHolder($data['cardHolder'] ?? null);
        $dto->setCustomerEmail($data['customerEmail'] ?? null);
        $this->setOrderDataInDto($dto, $order);

        return $dto;
    }

    /**
     * @param Charge $dto
     * @param Order  $order
     *
     * @return bool
     *
     * @throws \Exception
     */
    private function charge(Charge $dto, Order $order): bool
    {
        if (count($this->validator->validate($dto)) > 0) {
            return false;
        }

        $data = $this->solidGateService->charge($dto->getData());

        return $this->checkAndSaveOrderData($order, $data);
    }

    /**
     * @param Recurring $dto
     * @param Order     $order
     *
     * @return bool
     *
     * @throws \Exception
     */
    private function recurring(Recurring $dto, Order $order): bool
    {
        if (count($this->validator->validate($dto)) > 0) {
            return false;
        }

        $data = $this->solidGateService->recurring($dto->getData());

        return $this->checkAndSaveOrderData($order, $data);
    }

    /**
     * @param AbstractPaymentModel $dto
     * @param Order                $order
     */
    private function setOrderDataInDto(AbstractPaymentModel $dto, Order $order)
    {
        $dto->setAmount($order->getAmount()->getAmount());
        $dto->setCurrency($order->getAmount()->getCurrency());
        /** for localhost. + @todo check why my ip is wrong */
//        $ip = '127.0.0.1' == $request->getClientIp() ? '93.178.204.228' : $request->getClientIp();
        $ip = '93.178.204.228';
        $dto->setGeoCountry($this->countryService->getCountryCodeAlpha3($ip) ?? 'UKR');
        $dto->setIpAddress($ip);
        $dto->setOrderId($order->getOrderId());
        $dto->setOrderItems($order->getOrderItems());
        $dto->setOrderDescription('Description');
    }
}
