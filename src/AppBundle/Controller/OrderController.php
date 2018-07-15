<?php

namespace AppBundle\Controller;

use AppBundle\Service\OrderService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class OrderController.
 */
class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * @Route("/orders", name="orders")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('order/index.html.twig', [
            'pagination' => $this->orderService->getPaginationList($request),
        ]);
    }

    /**
     * @param OrderService $orderService
     *
     * @required
     */
    public function setProductService(OrderService $orderService): void
    {
        $this->orderService = $orderService;
    }
}
