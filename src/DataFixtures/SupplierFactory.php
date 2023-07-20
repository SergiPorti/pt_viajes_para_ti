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
            $name = $faker->name;
            $email = $faker->email;
            $phoneNumber = $faker->phoneNumber;
            $supplierType = $faker->randomElement(['hotel', 'pista', 'complemento']);
            $isActive = $faker->boolean;
            $dateTime = $faker->dateTime;

            $supplier = new Supplier($name, $email, $phoneNumber, $supplierType, $isActive, $dateTime);

            $manager->persist($supplier);
        }

        $manager->flush();
    }
}
