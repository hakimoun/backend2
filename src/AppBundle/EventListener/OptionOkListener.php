<?php


namespace AppBundle\EventListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class OptionOkListener
{
    private $response;

    public function __construct()
    {
        $this->response = 'OK';
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if( $event->getRequest()->getMethod() == Request::METHOD_OPTIONS){
            $response = new Response('OK');
            $response->headers->set('Allow','GET,POST,OPTIONS');
            $event->setResponse($response);
        }
    }
}