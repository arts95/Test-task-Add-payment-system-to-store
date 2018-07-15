<?php

namespace AppBundle\Controller;

use AppBundle\Service\ProductService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductController.
 */
class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @Route("/products", name="products")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('product/index.html.twig', [
            'pagination' => $this->productService->getPaginationList($request),
        ]);
    }

    /**
     * @param ProductService $productService
     *
     * @required
     */
    public function setProductService(ProductService $productService): void
    {
        $this->productService = $productService;
    }
}
