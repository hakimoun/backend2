<?php

namespace AppBundle\Controller;

use Doctrine\Common\Persistence\Event\LoadClassMetadataEventArgs;
use Doctrine\DBAL\Platforms\Keywords\ReservedKeywordsValidator;
use AppBundle\Entity\UserLocation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class UserController extends Controller
{
    //getuser by token

    //getfriends by user token

    //getplaces by user token

    //getconvergeces by user token

    //getUserLocations

    //getLastLocation

    /**
     * @Route("/userlocation", name="add_userlocation")
     */
    public function addLocationAction(Request $request){
        $em = $this->get('doctrine')->getManager();

        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);

            $userToken = $params['userToken'];
            $lat = $params['lat'];
            $lng = $params['lng'];

            $user = $em->getRepository('AppBundle:User')
                ->findOneBy(array("userToken"=>$userToken));

            $user->setLat($lat);
            $user->setLng($lng);
            $user->setLocationUpdateDate(new \Datetime());

            $newLocation = new UserLocation();
            $newLocation->setUser($user);
            $newLocation->setLng($lng);
            $newLocation->setLat($lat);
            $em->persist($newLocation);

            $em->flush();

            return new Response('OK');
        }

        return new Response('ERROR');

    }

}
