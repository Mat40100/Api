<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $nameList = ["B10","B11","B12","B12S","B12SE","B10Lite"];
        foreach ($nameList as $name) {
            $product = new Product();
            $product->setName($name);
            $product->setPrice(rand(150,500));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
