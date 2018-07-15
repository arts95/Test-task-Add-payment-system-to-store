<?php

namespace AppBundle\Service;

use AppBundle\Traits\PaginationListTrait;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductService
 */
class ProductService
{
    use PaginationListTrait;

    /**
     * @param Request $request
     *
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function getPaginationList(Request $request)
    {
        $query = $this->em->createQuery("SELECT p FROM AppBundle:Product p");

        return $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );
    }
}
