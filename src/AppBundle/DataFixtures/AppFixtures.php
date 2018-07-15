<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Currency;
use AppBundle\Entity\MoneyEmbedded;
use AppBundle\Entity\Product;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures
 */
class AppFixtures implements ORMFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $product = new Product();
            $product->setName(sprintf('product %d', $i));
            $product->setPrice(new MoneyEmbedded(100, Currency::UAH));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
