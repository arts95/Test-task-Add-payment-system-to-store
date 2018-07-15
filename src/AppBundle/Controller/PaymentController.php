<?php

namespace AppBundle\Controller;

use AppBundle\Service\PaymentService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PaymentController
 */
class PaymentController extends Controller
{
    /**
     * @var PaymentService
     */
    private $paymentService;

    /**
     * @Route("/pay/{productId}", name="pay")
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function payAction(Request $request)
    {
        $form = $this->paymentService->getForm($request);
        if ($form instanceof FormInterface) {
            return $this->render('payment/pay.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        return $this->redirectToRoute('orders');
    }

    /**
     * @Route("/pay-click/{productId}", name="pay-click")
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws \Exception
     */
    public function payClickAction(Request $request)
    {
        $form = $this->paymentService->getFormOneClick($request);
        if ($form instanceof FormInterface) {
            return $this->render('payment/pay.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        return $this->redirectToRoute('orders');
    }

    /**
     * @Route("/status/{orderId}", name="check_status")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Exception
     */
    public function statusAction(Request $request)
    {
        $this->paymentService->checkStatus($request);

        return $this->redirectToRoute('orders');
    }

    public function callbackAction()
    {
        /** @todo add process request from solidGate service */
    }

    /**
     * @param PaymentService $paymentService
     *
     * @required
     */
    public function setPaymentService(PaymentService $paymentService): void
    {
        $this->paymentService = $paymentService;
    }
}
