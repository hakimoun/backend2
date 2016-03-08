<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class ConvergenceController extends Controller
{
    /**
     * @Route("/convergence/mine", name="user_created_convergences")
     */
    public function mineAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $response = new JsonResponse();
        $convergences = null;

        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
            $userToken = $params['token'];
            $convergences = $em->getRepository('AppBundle:Convergence')
                ->findByCreator($userToken);

        }
        $response->setData($convergences);

        return $response;
    }

    /**
     * @Route("/convergence/invitation", name="user_invitated_convergeces")
     */
    public function invitationAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $response = new JsonResponse();
        $convergences = [];


        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
            $userToken = $params['token'];
            $convergences = $em->getRepository('AppBundle:Convergence')
                ->findByInvitation($userToken);

        }
        $response->setData($convergences);

        return $response;
    }

    /**
     * @Route("/convergence/history", name="user_history_convergences")
     */
    public function historyAction(Request $request)
    {
        $em = $this->get('doctrine')->getManager();
        $response = new JsonResponse();
        $convergences = [];


        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
            $userToken = $params['token'];

            //find all created
            $convergences = $em->getRepository('AppBundle:Convergence')
                ->findHistoryByCreator($userToken);
            $convergences = $em->getRepository('AppBundle:Convergence')
                ->findHistoryByInvitations($userToken);

        }
        $response->setData($convergences);

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
