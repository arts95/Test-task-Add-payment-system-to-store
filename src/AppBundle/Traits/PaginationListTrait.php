<?php

namespace AppBundle\Traits;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Trait PaginationListTrait.
 */
trait PaginationListTrait
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var PaginatorInterface
     */
    private $paginator;


    /**
     * @param PaginatorInterface $paginator
     *
     * @required
     */
    public function setPaginator(PaginatorInterface $paginator): void
    {
        $this->paginator = $paginator;
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
}
