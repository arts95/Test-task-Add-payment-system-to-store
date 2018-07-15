<?php

namespace unit\AppBundle\Service;

use AppBundle\Entity\Currency;
use AppBundle\Entity\MoneyEmbedded;
use AppBundle\Entity\Order;
use AppBundle\Service\CountryService;
use AppBundle\Service\PaymentService;
use Codeception\Stub\Expected;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class PaymentServiceTest
 * @codingStandardsIgnoreFile
 */
class PaymentServiceTest extends \Codeception\Test\Unit
{
    /**
     * @throws \Exception
     */
    public function testGetChargeData()
    {
        $order = new Order();
        $amount = new MoneyEmbedded(100, Currency::UAH);
        $order->setAmount($amount);
        $order->setOrderId('orderId');
        $order->setOrderItems('orderItems');
        /** @var CountryService $countryService */
        $countryService = $this->make(CountryService::class, ['getCountryCodeAlpha3' => 'USA']);

        $paymentService = new PaymentService();
        $paymentService->setCountryService($countryService);
        $data = [
            'cardCvv' => 'cardCvv',
            'cardNumber' => 'cardNumber',
            'cardExpMonth' => 'cardExpMonth',
            'cardExpYear' => 'cardExpYear',
            'cardHolder' => 'cardHolder',
            'customerEmail' => 'customerEmail',
        ];
        $charge = $paymentService->getChargeData($order, $data);

        $this->assertEquals('cardCvv', $charge->getCardCvv());
        $this->assertEquals('cardNumber', $charge->getCardNumber());
        $this->assertEquals('cardExpYear', $charge->getCardExpYear());
        $this->assertEquals('cardHolder', $charge->getCardHolder());
        $this->assertEquals('customerEmail', $charge->getCustomerEmail());
        $this->assertEquals($amount->getAmount(), $charge->getAmount());
        $this->assertEquals($amount->getCurrency(), $charge->getCurrency());
        $this->assertEquals('orderId', $charge->getOrderId());
        $this->assertEquals('orderItems', $charge->getOrderItems());
        $this->assertEquals('USA', $charge->getGeoCountry());
    }

    /**
     * @throws \Exception
     */
    public function testGetRecurringData()
    {
        $order = new Order();
        $amount = new MoneyEmbedded(100, Currency::UAH);
        $order->setAmount($amount);
        $order->setOrderId('orderId');
        $order->setOrderItems('orderItems');
        /** @var CountryService $countryService */
        $countryService = $this->make(CountryService::class, ['getCountryCodeAlpha3' => 'USA']);

        $paymentService = new PaymentService();
        $paymentService->setCountryService($countryService);
        $data = [
            'recurringToken' => 'recurringToken',
            'customerEmail' => 'customerEmail',
        ];
        $recurring = $paymentService->getRecurringData($order, $data);

        $this->assertEquals('recurringToken', $recurring->getRecurringToken());
        $this->assertEquals($amount->getAmount(), $recurring->getAmount());
        $this->assertEquals($amount->getCurrency(), $recurring->getCurrency());
        $this->assertEquals('orderId', $recurring->getOrderId());
        $this->assertEquals('orderItems', $recurring->getOrderItems());
        $this->assertEquals('USA', $recurring->getGeoCountry());
    }

    /**
     * @throws \Exception
     */
    public function testCheckAndSaveOrderData()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->make(EntityManager::class, [
            'persist' => Expected::atLeastOnce(),
            'flush' => Expected::exactly(2)
        ]);
        /** @var ValidatorInterface $validator */
        $validator = $this->makeEmpty(ValidatorInterface::class, [
            'validate' => Expected::atLeastOnce([]),
        ]);

        $paymentService = new PaymentService();
        $paymentService->setEm($em);
        $paymentService->setValidator($validator);
        $this->assertTrue($paymentService->checkAndSaveOrderData(new Order(), $this->getDataForCheckAndSaveFunction()));
    }

    /**
     * @return array
     */
    private function getDataForCheckAndSaveFunction(): array
    {
        return [
            "transactions" => [
                "3c757c24-8804-11e8-84fd-0242ac1400025b4afd9a4004b" => [
                    "id" => "3c757c24-8804-11e8-84fd-0242ac1400025b4afd9a4004b",
                    "operation" => "recurring",
                    "status" => "success",
                    "descriptor" => "FakeONE",
                    "amount" => 100,
                    "currency" => "UAH",
                    "card" => [
                        "bank" => "CITIZENS STATE BANK",
                        "bin" => "453245",
                        "brand" => "VISA",
                        "country" => "USA",
                        "number" => "453245XXXXXX2692",
                        "card_token" => [
                            "token" => "4a12fc8638f646a5c80c11132826f8cfbeb117fae048f8842258c26366b06f33171ec8cc787f45aeaaafe1975aa95467deb4"
                        ],
                    ],

                ],
            ],
            "order" => [
                "order_id" => "3c757c24-8804-11e8-84fd-0242ac140002",
                "status" => "processing",
                "amount" => 100,
                "refunded_amount" => 0,
                "currency" => "UAH",
                "marketing_amount" => 4,
                "marketing_currency" => "USD",
                "processing_amount" => 100,
                "processing_currency" => "UAH",
                "descriptor" => "FakeONE",
                "fraudulent" => true,
                "total_fee_amount" => 0,
                "fee_currency" => "USD",
            ],
        ];
    }
}
