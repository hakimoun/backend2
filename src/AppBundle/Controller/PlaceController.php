<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class PlaceController extends Controller
{
    /**
     * @Route("/place", name="user_places")
     */
    public function getAllAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $response = new JsonResponse();
        $places = null;


        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
            $userToken = $params['token'];
            $places = $em->getRepository('AppBundle:Place')
                ->findByCreator($userToken);

        }
        $response->setData($places);

        return $response;
    }

}
