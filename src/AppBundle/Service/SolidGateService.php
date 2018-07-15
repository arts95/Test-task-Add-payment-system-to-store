<?php

namespace AppBundle\Service;

use AppBundle\Interfaces\ApiInterface;
use Psr\Log\LoggerInterface;
use Signedpay\API\Api;

/**
 * Class SolidGateService
 */
class SolidGateService implements ApiInterface
{
    /**
     * @var Api
     */
    private $api;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * SolidGateService constructor.
     * @param Api             $api
     * @param LoggerInterface $logger
     */
    public function __construct(Api $api, LoggerInterface $logger)
    {
        $this->api = $api;
        $this->logger = $logger;
    }

    /**
     * @param array $attributes
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     *
     * @throws \Exception
     */
    public function charge(array $attributes)
    {
        return $this->makeRequest('charge', $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     *
     * @throws \Exception
     */
    public function recurring(array $attributes)
    {
        return $this->makeRequest('recurring', $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     *
     * @throws \Exception
     */
    public function status(array $attributes)
    {
        return $this->makeRequest('status', $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     *
     * @throws \Exception
     */
    public function refund(array $attributes)
    {
        return $this->makeRequest('refund', $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     *
     * @throws \Exception
     */
    public function initPayment(array $attributes)
    {
        return $this->makeRequest('initPayment', $attributes);
    }

    /**
     * @return \Exception
     */
    public function getException()
    {
        return $this->api->getException();
    }

    /**
     * @param string $path
     * @param array  $attributes
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     *
     * @throws \Exception
     */
    private function makeRequest(string $path, array $attributes)
    {
        switch ($path) {
            case 'initPayment':
                $data = $this->api->initPayment($attributes);
                break;
            case 'refund':
                $data = $this->api->refund($attributes);
                break;
            case 'charge':
                $data = $this->api->charge($attributes);
                break;
            case 'recurring':
                $data = $this->api->recurring($attributes);
                break;
            case 'status':
                $data = $this->api->status($attributes);
                break;
            default:
                throw new \Exception('Method not found');
        }

        $this->logger->info($path, $data);

        return $data;
    }
}
