<?php

namespace App\DataFixtures;

use App\Entity\Supplier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SupplierFactory extends Fixture
{
    /**
     * Summary of load
     * @param \Doctrine\Persistence\ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $supplier = new Supplier();
            $supplier->setName($faker->name);
            $supplier->setEmail($faker->email);
            $supplier->setPhoneNumber($faker->phoneNumber());
            $supplier->setSupplierType($faker->randomElement(['hotel', 'pista', 'complemento']));
            $supplier->setIsActive($faker->boolean);
            $supplier->setCreatedAt($faker->dateTime);

            $manager->persist($supplier);
        }

        $manager->flush();
    }
}
