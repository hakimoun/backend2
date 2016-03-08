<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class FriendController extends Controller
{
    /**
     * @Route("/friend", name="user_friends")
     */
    public function getAllAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $response = new JsonResponse();
        $friends = null;


        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
            $userToken = $params['token'];
            $friends = $em->getRepository('AppBundle:Friend')
                ->findByCreator($userToken);

        }
        $response->setData($friends);

        return $response;
    }

}
