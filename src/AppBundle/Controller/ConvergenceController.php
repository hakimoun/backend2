<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class ConvergenceController extends Controller
{
    /**
     * @Route("/convergence/mine", name="homepage")
     */
    public function mineAction(Request $request)
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
            ->findAll();

        }
        $response->setData($convergences);

        return $response;
    }
}
