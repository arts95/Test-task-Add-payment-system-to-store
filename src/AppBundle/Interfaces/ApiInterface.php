<?php

namespace AppBundle\Interfaces;

/**
 * Interface ApiInterface
 */
interface ApiInterface
{
    /**
     * @param array $attributes
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function charge(array $attributes);

    /**
     * @param array $attributes
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function recurring(array $attributes);

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function status(array $attributes);

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function refund(array $attributes);

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function initPayment(array $attributes);

    /**
     * @return \Exception
     */
    public function getException();
}
