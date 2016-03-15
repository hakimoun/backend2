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
        $convergence->setCreatorToken($hakim->getUSerToken());
        $convergence->setDescription("description description description description description ");
        $convergence->setPlace($place);
        $convergence->setTags("tag1, tag2, tag3");
        $convergence->setWhen((new \DateTime())->add(new \DateInterval('PT1H')));
        $convergence->setIsActive(true);
        $manager->persist($convergence);

        $convergence2 = new Convergence();
        $convergence2->setCreator($hakim);
        $convergence2->setName("Une biere au bistrot mais c trop tard");
        $convergence2->setCreatorToken($hakim->getUSerToken());
        $convergence2->setDescription("description description description description description c trop tard ");
        $convergence2->setPlace($place);
        $convergence2->setTags("tag1, tag2, tag3");
        $convergence2->setWhen((new \DateTime())->sub(new \DateInterval('PT1H')));
        $convergence2->setIsActive(false);
        $manager->persist($convergence2);

        $manager->flush();

        $this->addReference("convergence-1", $convergence);
    }

    public function getOrder(){
        return 4;
    }

}
