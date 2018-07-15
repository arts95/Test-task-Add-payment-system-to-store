<?php

namespace AppBundle\DTO;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class BasePaymentModel
 */
abstract class AbstractPaymentModel
{
    /**
     * @var int
     *
     * @Assert\NotBlank()
     */
    protected $amount;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 3
     * )
     */
    protected $currency;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 100
     * )
     */
    protected $customerAccountId;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 50
     * )
     */
    protected $customerDateOfBirth;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Assert\Length(
     *      max = 100
     * )
     */
    protected $customerEmail;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 100
     * )
     */
    protected $customerFirstName;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 100
     * )
     */
    protected $customerLastName;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 100
     * )
     */
    protected $customerPhone;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $formDesignName;

    /**
     * @var bool|null
     *
     */
    protected $fraudulent;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 3
     * )
     */
    protected $geoCountry;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 100
     * )
     */
    protected $geoCity;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 50
     * )
     */
    protected $ipAddress;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 2
     * )
     */
    protected $language;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $orderId;

    /**
     * @var int|null
     */
    protected $orderNumber;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 50
     * )
     */
    protected $orderDate;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $orderDescription;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $orderItems;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 6
     * )
     */
    protected $platform = 'WEB';

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $callbackUrl;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $failUrl;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $successUrl;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $chargeBackNotificationUrl;

    /**
     * @var bool|null
     */
    protected $verified;

    /**
     * @var int|null
     *
     */
    protected $retryAttempt;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $trafficSource;

    /**
     * @var string|null
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    protected $transactionSource;

    /**
     * @var string|null
     */
    protected $userAgent;

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return null|string
     */
    public function getCustomerAccountId(): ?string
    {
        return $this->customerAccountId;
    }

    /**
     * @param null|string $customerAccountId
     */
    public function setCustomerAccountId(?string $customerAccountId): void
    {
        $this->customerAccountId = $customerAccountId;
    }

    /**
     * @return null|string
     */
    public function getCustomerDateOfBirth(): ?string
    {
        return $this->customerDateOfBirth;
    }

    /**
     * @param null|string $customerDateOfBirth
     */
    public function setCustomerDateOfBirth(?string $customerDateOfBirth): void
    {
        $this->customerDateOfBirth = $customerDateOfBirth;
    }

    /**
     * @return string|null
     */
    public function getCustomerEmail(): ?string
    {
        return $this->customerEmail;
    }

    /**
     * @param string $customerEmail
     */
    public function setCustomerEmail(string $customerEmail): void
    {
        $this->customerEmail = $customerEmail;
    }

    /**
     * @return null|string
     */
    public function getCustomerFirstName(): ?string
    {
        return $this->customerFirstName;
    }

    /**
     * @param null|string $customerFirstName
     */
    public function setCustomerFirstName(?string $customerFirstName): void
    {
        $this->customerFirstName = $customerFirstName;
    }

    /**
     * @return null|string
     */
    public function getCustomerLastName(): ?string
    {
        return $this->customerLastName;
    }

    /**
     * @param null|string $customerLastName
     */
    public function setCustomerLastName(?string $customerLastName): void
    {
        $this->customerLastName = $customerLastName;
    }

    /**
     * @return null|string
     */
    public function getCustomerPhone(): ?string
    {
        return $this->customerPhone;
    }

    /**
     * @param null|string $customerPhone
     */
    public function setCustomerPhone(?string $customerPhone): void
    {
        $this->customerPhone = $customerPhone;
    }

    /**
     * @return null|string
     */
    public function getFormDesignName(): ?string
    {
        return $this->formDesignName;
    }

    /**
     * @param null|string $formDesignName
     */
    public function setFormDesignName(?string $formDesignName): void
    {
        $this->formDesignName = $formDesignName;
    }

    /**
     * @return bool|null
     */
    public function getFraudulent(): ?bool
    {
        return $this->fraudulent;
    }

    /**
     * @param bool|null $fraudulent
     */
    public function setFraudulent(?bool $fraudulent): void
    {
        $this->fraudulent = $fraudulent;
    }

    /**
     * @return string
     */
    public function getGeoCountry(): string
    {
        return $this->geoCountry;
    }

    /**
     * @param string $geoCountry
     */
    public function setGeoCountry(string $geoCountry): void
    {
        $this->geoCountry = $geoCountry;
    }

    /**
     * @return null|string
     */
    public function getGeoCity(): ?string
    {
        return $this->geoCity;
    }

    /**
     * @param null|string $geoCity
     */
    public function setGeoCity(?string $geoCity): void
    {
        $this->geoCity = $geoCity;
    }

    /**
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     */
    public function setIpAddress(string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return null|string
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param null|string $language
     */
    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return int|null
     */
    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }

    /**
     * @param int|null $orderNumber
     */
    public function setOrderNumber(?int $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @return null|string
     */
    public function getOrderDate(): ?string
    {
        return $this->orderDate;
    }

    /**
     * @param null|string $orderDate
     */
    public function setOrderDate(?string $orderDate): void
    {
        $this->orderDate = $orderDate;
    }

    /**
     * @return string
     */
    public function getOrderDescription(): string
    {
        return $this->orderDescription;
    }

    /**
     * @param string $orderDescription
     */
    public function setOrderDescription(string $orderDescription): void
    {
        $this->orderDescription = $orderDescription;
    }

    /**
     * @return null|string
     */
    public function getOrderItems(): ?string
    {
        return $this->orderItems;
    }

    /**
     * @param null|string $orderItems
     */
    public function setOrderItems(?string $orderItems): void
    {
        $this->orderItems = $orderItems;
    }

    /**
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }

    /**
     * @param string $platform
     */
    public function setPlatform(string $platform): void
    {
        $this->platform = $platform;
    }

    /**
     * @return null|string
     */
    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    /**
     * @param null|string $callbackUrl
     */
    public function setCallbackUrl(?string $callbackUrl): void
    {
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * @return null|string
     */
    public function getFailUrl(): ?string
    {
        return $this->failUrl;
    }

    /**
     * @param null|string $failUrl
     */
    public function setFailUrl(?string $failUrl): void
    {
        $this->failUrl = $failUrl;
    }

    /**
     * @return null|string
     */
    public function getSuccessUrl(): ?string
    {
        return $this->successUrl;
    }

    /**
     * @param null|string $successUrl
     */
    public function setSuccessUrl(?string $successUrl): void
    {
        $this->successUrl = $successUrl;
    }

    /**
     * @return null|string
     */
    public function getChargeBackNotificationUrl(): ?string
    {
        return $this->chargeBackNotificationUrl;
    }

    /**
     * @param null|string $chargeBackNotificationUrl
     */
    public function setChargeBackNotificationUrl(?string $chargeBackNotificationUrl): void
    {
        $this->chargeBackNotificationUrl = $chargeBackNotificationUrl;
    }

    /**
     * @return bool|null
     */
    public function getVerified(): ?bool
    {
        return $this->verified;
    }

    /**
     * @param bool|null $verified
     */
    public function setVerified(?bool $verified): void
    {
        $this->verified = $verified;
    }

    /**
     * @return int|null
     */
    public function getRetryAttempt(): ?int
    {
        return $this->retryAttempt;
    }

    /**
     * @param int|null $retryAttempt
     */
    public function setRetryAttempt(?int $retryAttempt): void
    {
        $this->retryAttempt = $retryAttempt;
    }

    /**
     * @return null|string
     */
    public function getTrafficSource(): ?string
    {
        return $this->trafficSource;
    }

    /**
     * @param null|string $trafficSource
     */
    public function setTrafficSource(?string $trafficSource): void
    {
        $this->trafficSource = $trafficSource;
    }

    /**
     * @return null|string
     */
    public function getTransactionSource(): ?string
    {
        return $this->transactionSource;
    }

    /**
     * @param null|string $transactionSource
     */
    public function setTransactionSource(?string $transactionSource): void
    {
        $this->transactionSource = $transactionSource;
    }

    /**
     * @return null|string
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    /**
     * @param null|string $userAgent
     */
    public function setUserAgent(?string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $data = [];

        /** @todo add all parameters */
        $data['amount'] = $this->amount;
        $data['currency'] = $this->currency;
        $data['customer_email'] = $this->customerEmail;
        $data['geo_country'] = $this->geoCountry;
        $data['ip_address'] = $this->ipAddress;
        $data['order_id'] = $this->orderId;
        $data['order_description'] = $this->orderDescription;
        $data['platform'] = $this->platform;
        $data['platform'] = $this->platform;
        $data['callback_url'] = $this->callbackUrl;
        $data['fail_url'] = $this->failUrl;
        $data['success_url'] = $this->successUrl;

        return $this->removeNullValue($data);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function removeNullValue(array $data): array
    {
        foreach ($data as $key => $value) {
            if (null === $value) {
                unset($data[$key]);
            }
        }

        return $data;
    }
}
