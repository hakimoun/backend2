<?php


namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Invitation;

class LoadInvitationData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){
        $hakim = $this->getReference('user-hakim');
        $convergence = $this->getReference('convergence-1');
        $invitee1 = $this->getReference('invitee-1');
        $invitee2 = $this->getReference('invitee-2');
        $invitee3 = $this->getReference('invitee-3');

        $invitation1 =  new Invitation();
        $invitation1->setConvergence($convergence);
        $invitation1->setMessage('viens mon invitee numero 1');
        $invitation1->setPublicDescription('cette personne est trop gentille !');
        $invitation1->setToken('invitation1');
        $invitation1->setUser($invitee1);
        $invitation1->setCreator($hakim);

        $invitation2 =  new Invitation();
        $invitation2->setConvergence($convergence);
        $invitation2->setMessage('viens mon invitee numero 2');
        $invitation2->setPublicDescription('cette personne est trop gentille 2!');
        $invitation2->setToken('invitation2');
        $invitation2->setUser($invitee2);
        $invitation2->setCreator($hakim);

        $invitation3 =  new Invitation();
        $invitation3->setConvergence($convergence);
        $invitation3->setMessage('viens mon invitee numero 3');
        $invitation3->setPublicDescription('cette personne est trop gentille 3!');
        $invitation3->setToken('invitation3');
        $invitation3->setUser($invitee3);
        $invitation3->setCreator($hakim);


        $manager->persist($invitation1);
        $manager->persist($invitation2);
        $manager->persist($invitation3);
        $manager->flush();

    }

    public function getOrder(){
        return 5;
    }

}
