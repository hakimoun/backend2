<?php


namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Convergence;

class LoadConvergenceData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){
        $hakim = $this->getReference("user-hakim");
        $place = $this->getReference("place-1");

        $convergence = new Convergence();
        $convergence->setCreator($hakim);
        $convergence->setName("Une biere au bistrot");
        $convergence->setCreatorToken("123456789");
        $convergence->setDescription("description description description description description ");
        $convergence->setPlace($place);
        $convergence->setTags("tag1, tag2, tag3");
        $convergence->setWhen((new \DateTime())->add(new \DateInterval('PT1H')));

        $manager->persist($convergence);
        $manager->flush();

        $this->addReference("convergence-1", $convergence);
    }

    public function getOrder(){
        return 4;
    }

}
