<?php

namespace AppBundle\DTO;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Recurring.
 */
class Recurring extends AbstractPaymentModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $recurringToken;

    /**
     * @return array
     */
    public function getData(): array
    {
        $data = parent::getData();
        $data['recurring_token'] = $this->recurringToken;

        return $this->removeNullValue($data);
    }

    /**
     * @return string
     */
    public function getRecurringToken(): string
    {
        return $this->recurringToken;
    }

    /**
     * @param string $recurringToken
     */
    public function setRecurringToken(string $recurringToken): void
    {
        $this->recurringToken = $recurringToken;
    }
}
