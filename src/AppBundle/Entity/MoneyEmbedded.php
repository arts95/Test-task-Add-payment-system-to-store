<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class MoneyEmbedded.
 *
 * @ORM\Embeddable
 */
class MoneyEmbedded
{
    /**
     * @var int
     *
     * @Assert\GreaterThan(value="0")
     * @Assert\Range(max="9223372036854775800")
     * @Assert\Type(type="numeric")
     *
     * @Groups("read_money")
     *
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $amount;

    /**
     * @var string
     *
     * @Assert\Currency
     *
     * @Groups("read_money")
     *
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $currency;

    /**
     * MoneyEmbedded constructor.
     *
     * @param int|null    $amount
     * @param string|null $currency
     */
    public function __construct(int $amount = null, string $currency = null)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string|null
     */
    public function getReadableAmount()
    {
        $currencies = new ISOCurrencies();

        $moneyFormatter = new DecimalMoneyFormatter($currencies);

        try {
            $formatted = $moneyFormatter->format($this->getValue());
        } catch (\InvalidArgumentException $e) {
            return null;
        }

        return $formatted;
    }

    /**
     * @return Money
     */
    public function getValue()
    {
        return new Money($this->amount, new \Money\Currency($this->currency));
    }

    /**
     * @param Money $money
     */
    public function setValue(Money $money)
    {
        $this->amount = (int) $money->getAmount();
        $this->currency = $money->getCurrency()->getCode();
    }
}
