<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Responses;

class ResponsesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 6; $i++) {
            $responses = new Responses();
            $responses->setResponseValue("2")
                ->setResponseDate(new \DateTime())
                ->setResponseTime(new \DateTime());
            $manager->persist($responses);
        }
        $manager->flush();
    }
}