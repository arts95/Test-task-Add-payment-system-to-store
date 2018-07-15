<?php

namespace AppBundle\DTO;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Charge.
 */
class Charge extends AbstractPaymentModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 25
     * )
     */
    protected $cardNumber;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 50
     * )
     */
    protected $cardHolder;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min=2,
     *      max=2
     * )
     */
    protected $cardExpMonth;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min=4,
     *      max=4
     * )
     */
    protected $cardExpYear;


    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min=3,
     *      max=4
     * )
     */
    protected $cardCvv;

    /**
     * @var string|null
     *
     * @todo add validation for NGA
     *
     * @Assert\Length(
     *      min=3,
     *      max=4
     * )
     */
    protected $cardPin;

    /**
     * @var string|null
     *
     * @todo add not blank for USA
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $city;

    /**
     * @var string|null
     *
     * @todo add not blank for brazilian
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $cpf;

    /**
     * @var string|null
     *
     * @todo add validation not blank for USA
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $address;

    /**
     * @var string|null
     *
     * @todo add validation not blank for USA
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $state;

    /**
     * @var string|null
     *
     * @todo add validation not blank for USA
     *
     * @Assert\Length(
     *      max = 10
     * )
     */
    protected $zipCode;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $statusUrl;

    /**
     * @return null|string
     */
    public function getStatusUrl(): ?string
    {
        return $this->statusUrl;
    }

    /**
     * @param null|string $statusUrl
     */
    public function setStatusUrl(?string $statusUrl): void
    {
        $this->statusUrl = $statusUrl;
    }

    /**
     * @return null|string
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @param null|string $zipCode
     */
    public function setZipCode(?string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return null|string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param null|string $state
     */
    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return string|null
     */
    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     */
    public function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * @return string|null
     */
    public function getCardHolder(): ?string
    {
        return $this->cardHolder;
    }

    /**
     * @param string $cardHolder
     */
    public function setCardHolder(string $cardHolder): void
    {
        $this->cardHolder = $cardHolder;
    }

    /**
     * @return string|null
     */
    public function getCardExpMonth(): ?string
    {
        return $this->cardExpMonth;
    }

    /**
     * @param string $cardExpMonth
     */
    public function setCardExpMonth(string $cardExpMonth): void
    {
        $this->cardExpMonth = $cardExpMonth;
    }

    /**
     * @return string|null
     */
    public function getCardExpYear(): ?string
    {
        return $this->cardExpYear;
    }

    /**
     * @param string $cardExpYear
     */
    public function setCardExpYear(string $cardExpYear): void
    {
        $this->cardExpYear = $cardExpYear;
    }

    /**
     * @return string|null
     */
    public function getCardCvv(): ?string
    {
        return $this->cardCvv;
    }

    /**
     * @param string $cardCvv
     */
    public function setCardCvv(string $cardCvv): void
    {
        $this->cardCvv = $cardCvv;
    }

    /**
     * @return null|string
     */
    public function getCardPin(): ?string
    {
        return $this->cardPin;
    }

    /**
     * @param null|string $cardPin
     */
    public function setCardPin(?string $cardPin): void
    {
        $this->cardPin = $cardPin;
    }

    /**
     * @return null|string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param null|string $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return null|string
     */
    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    /**
     * @param null|string $cpf
     */
    public function setCpf(?string $cpf): void
    {
        $this->cpf = $cpf;
    }

    /**
     * @return null|string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param null|string $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $data = parent::getData();
        $data['card_number'] = $this->cardNumber;
        $data['card_holder'] = $this->cardHolder;
        $data['card_exp_month'] = $this->cardExpMonth;
        $data['card_exp_year'] = $this->cardExpYear;
        $data['card_cvv'] = $this->cardCvv;
        $data['card_pin'] = $this->cardPin;

        return $this->removeNullValue($data);
    }
}
