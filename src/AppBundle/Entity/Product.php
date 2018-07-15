<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 *
 * @ORM\Entity()
 */
class Product
{
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
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var MoneyEmbedded
     *
     * @ORM\Embedded(class="AppBundle\Entity\MoneyEmbedded")
     */
    private $price;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return MoneyEmbedded
     */
    public function getPrice(): MoneyEmbedded
    {
        return $this->price;
    }

    /**
     * @param MoneyEmbedded $price
     */
    public function setPrice(MoneyEmbedded $price): void
    {
        $this->price = $price;
    }
}
