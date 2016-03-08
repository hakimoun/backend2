<?php


namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){
        $hakim = new User();
        $hakim->setEmail('hakimoun@yopmail.com');
        $hakim->setPhone('098765432');
        $hakim->setFirstname('hakim');
        $hakim->setLastname('ould ahmed');
        $hakim->setImage("hakim.jpg");

        $invitee1 = new User();
        $invitee1->setEmail("nacima@yopmail.com");
        $invitee1->setFirstname("nacima");
        $invitee1->setLastname("cherrak");
        $invitee1->setPhone(null);
        $invitee1->setImage("nacima.jpg");

        $invitee2 = new User();
        $invitee2->setEmail("ariles@yopmail.com");
        $invitee2->setFirstname("ariles");
        $invitee2->setLastname("ould ahmed");
        $invitee2->setPhone(null);
        $invitee2->setImage("ariles.jpg");

        $invitee3 = new User();
        $invitee3->setEmail("nacima@yahoo.fr");
        $invitee3->setFirstname("louise");
        $invitee3->setLastname("ould ahmed");
        $invitee3->setPhone("0123456789");
        $invitee3->setImage("louise.jpg");

        $manager->persist($hakim);
        $manager->persist($invitee1);
        $manager->persist($invitee2);
        $manager->persist($invitee3);
        $manager->flush();

        $this->addReference('user-hakim', $hakim);
        $this->addReference('invitee-1', $invitee1);
        $this->addReference('invitee-2', $invitee2);
        $this->addReference('invitee-3', $invitee3);

    }

    public function getOrder(){
        return 1;
    }

}
