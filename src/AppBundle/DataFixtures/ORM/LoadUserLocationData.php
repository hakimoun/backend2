<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\UserLocation;

class LoadUserLocationData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        $hakim = $this->getReference('user-hakim');

        $location = new UserLocation();
        $location->setUser($hakim);
        $location->setLat("35.7021906");
        $location->setLng("4.0493255");

        $manager->persist($location);
        $manager->flush();

        $this->addReference('location-1', $location);
    }

    public function getOrder(){
        return 3;
    }

}
