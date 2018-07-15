<?php

namespace AppBundle\Service;

use AppBundle\Entity\Order;
use AppBundle\Entity\Product;
use AppBundle\Traits\PaginationListTrait;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class OrderService.
 */
class OrderService
{
    use PaginationListTrait;

    /**
     * @param Request $request
     *
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function getPaginationList(Request $request)
    {
        $query = $this->em->createQuery("SELECT o FROM AppBundle:Order o ORDER BY o.id DESC");

        return $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );
    }

    /**
     * @param Product $product
     *
     * @return Order
     */
    public function createOrder(Product $product): Order
    {
        $order = new Order();
        try {
            $uuid1 = Uuid::uuid1();
        } catch (UnsatisfiedDependencyException $e) {
            throw new HttpException(500, sprintf('Caught exception: %s', $e->getMessage()));
        }
        $order->setOrderId($uuid1);
        $order->setAmount($product->getPrice());
        $order->setOrderItems($product->getName());
        $this->em->persist($order);
        $this->em->flush();

        return $order;
    }
}
