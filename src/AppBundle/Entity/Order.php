<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Order.
 * @ORM\Entity()
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="search_idx", columns={"order_id", "status"})})
 */
class Order
{
    const STATUS_DEFAULT = 'default';
    const STATUS_CREATED = 'created';
    const STATUS_PROCESSING = 'processing';
    const STATUS_3DS_VERIFY = '3ds_verify';
    const STATUS_APPROVED = 'approved';
    const STATUS_DECLINED = 'declined';
    const STATUS_REFUNDED = 'refunded';
    const STATUS_AUTH = 'auth';
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     *
     * @Assert\Uuid()
     */
    private $orderId;

    /**
     * @var MoneyEmbedded
     *
     * @ORM\Embedded(class="AppBundle\Entity\MoneyEmbedded")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $orderItems;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->status = self::STATUS_DEFAULT;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return MoneyEmbedded
     */
    public function getAmount(): MoneyEmbedded
    {
        return $this->amount;
    }

    /**
     * @param MoneyEmbedded $amount
     */
    public function setAmount(MoneyEmbedded $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @throws \Exception
     */
    public function setStatus(string $status): void
    {
        if (isset(self::getStatuses()[$status])) {
            $this->status = $status;
        } else {
            throw new \Exception('Order status not found');
        }
    }

    /**
     * @return array
     */
    public function getStatuses(): array
    {
        return [
            self::STATUS_DEFAULT => self::STATUS_DEFAULT,
            self::STATUS_CREATED => self::STATUS_CREATED,
            self::STATUS_PROCESSING => self::STATUS_PROCESSING,
            self::STATUS_3DS_VERIFY => self::STATUS_3DS_VERIFY,
            self::STATUS_APPROVED => self::STATUS_APPROVED,
            self::STATUS_DECLINED => self::STATUS_DECLINED,
            self::STATUS_REFUNDED => self::STATUS_REFUNDED,
            self::STATUS_AUTH => self::STATUS_AUTH,
        ];
    }

    /**
     * @return string
     */
    public function getOrderItems(): string
    {
        return $this->orderItems;
    }

    /**
     * @param string $orderItems
     */
    public function setOrderItems(string $orderItems): void
    {
        $this->orderItems = $orderItems;
    }
}
