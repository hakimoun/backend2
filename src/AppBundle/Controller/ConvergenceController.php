<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ConvergenceController extends Controller
{
    /**
     * @Route("/convergence/mine", name="user_created_convergences")
     */
    public function mineAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();

        $serializer = $this->container->get('serializer');
        $convergences = null;

        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
            $userToken = $params['userToken'];
            $convergences = $em->getRepository('AppBundle:Convergence')
                ->findBy(array("creatorToken"=>$userToken, 'is_active'=>true));
            $jsonContent = $serializer->serialize($convergences, 'json');
        }

        $response = new Response(json_encode($jsonContent));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/convergence/invitation", name="user_invitated_convergeces")
     */
    public function invitationAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $serializer = $this->container->get('serializer');

        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
            $userToken = $params['userToken'];
            $convergences = $em->getRepository('AppBundle:Convergence')
                ->findByInvitation($userToken, true);
            $jsonContent = $serializer->serialize($convergences, 'json');

        }

        $response = new Response(json_encode($jsonContent));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/convergence/history", name="user_history_convergences")
     */
    public function historyAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $serializer = $this->container->get('serializer');

        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
            $userToken = $params['userToken'];

            $convergencesMine = $em->getRepository('AppBundle:Convergence')
                ->findBy(array("creatorToken"=>$userToken, 'is_active'=>false));
            $convergencesInvitations = $em->getRepository('AppBundle:Convergence')
                ->findByInvitation($userToken, false);
            $convergences = $convergencesMine + $convergencesInvitations;

            $jsonContent = $serializer->serialize($convergences, 'json');

        }
        $response = new Response(json_encode($jsonContent));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/convergence", name="create_convergence")
     */
    public function createAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $response = new JsonResponse();
        $convergences = [];


        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
            $userToken = $params['token'];

            //new users
            //new place
            //new convergence
            //new invitations

        }
        $response->setData($convergence);

        return $response;
    }


}
