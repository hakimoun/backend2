<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Convergence;
use AppBundle\Entity\Invitation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Entity\Place;


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
        $serializer = $this->container->get('serializer');

        $content = $request->getContent();
        if($request->getMethod() == Request::METHOD_OPTIONS)
        {
            print_r ('OK');exit;
        }
        if (!empty($content))
        {
            $params = json_decode($content, true);

            $creator = $params['creator']; // pseudo, firstname, lastname, email, phone, lat, lng, image
            $convergence = $params['information']; // name, description, image, tags
            $place = $params['place'];//googlePlace, lat, lng, name
            $when = $params['when'];  //dateime
            $friends = $params['friends'];  //array of friend, each friend is : psueod, firstame, lastname, email,image

            //new users creator and friends
            $newCreator = new User();
            $newCreator->setPseudo($creator['pseudo']);
            $newCreator->setFirstname($creator['firstname']);
            $newCreator->setLastname($creator['lastname']);
            $newCreator->setEmail($creator['email']);
            $newCreator->setPhone($creator['phone']);
            $newCreator->setImage($creator['image']);
            $newCreator->setUserToken(uniqid('user_'));

            $em->persist($newCreator);

            foreach($friends as &$friend){
                $newFriend = new User();
                $newFriend->setPseudo($friend['pseudo']);
                $newFriend->setFirstname($friend['firstname']);
                $newFriend->setLastname($friend['lastname']);
                $newFriend->setEmail($friend['email']);
                $newFriend->setPhone($friend['phone']);
                $newFriend->setImage($friend['image']);
                $newFriend->setUserToken(uniqid('user_'));

                $em->persist($newFriend);

                $friend['user'] = $newFriend;
            }

            $newPlace = new Place();
            $newPlace->setCreator($newCreator);
            $newPlace->setGooglePlaceJson(json_encode(json_decode($place['googlePlace'])));
            $newPlace->setName($place['name']);
            $newPlace->setLat($place['lat']);
            $newPlace->setLng($place['lng']);
            $em->persist($newPlace);

            $newConvergence = new Convergence();
            $newConvergence->setCreator($newCreator);
            $newConvergence->setPlace($newPlace);
            $newConvergence->setName($convergence['name']);
            $newConvergence->setDescription($convergence['description']);
            $newConvergence->setTags($convergence['tags']);
            $newConvergence->setCreatorToken($newCreator->getUserToken());
            $newConvergence->setIsActive(true);
            $newConvergence->setWhen(new \DateTime($when));
            $em->persist($newConvergence);

            foreach($friends as &$friend){
                $newInvitation = new Invitation();
                $newInvitation->setConvergence($newConvergence);
                $newInvitation->setCreator($newCreator);
                $newInvitation->setMessage($friend['message']);
                $newInvitation->setPublicDescription($friend['description']);
                $newInvitation->setToken(uniqid('invit_'));
                $newInvitation->setUser($friend['user']);

                $em->persist($newInvitation);
            }

            $em->flush();

        }

        $convergenceResponse = ["name"=>$newConvergence->getName(),
                                "description"=>$newConvergence->getDescription(),
                                "tags"=>$newConvergence->getTags()];
        $convergenceResponse['place'] =[];
        $convergenceResponse['place']['googlePlace'] = $newConvergence->getPlace()->getGooglePlaceJson();
        $convergenceResponse['place']['name'] = $newConvergence->getPlace()->getName();
        $convergenceResponse['place']['lat'] = $newConvergence->getPlace()->getLat();
        $convergenceResponse['place']['lng'] = $newConvergence->getPlace()->getLng();
        $convergenceResponse['creator'] =
            [
             "pseudo"=>$newConvergence->getCreator()->getPseudo(),
             "firstname"=>$newConvergence->getCreator()->getFirstname(),
             "lastname"=>$newConvergence->getCreator()->getLastname(),
             "userToken"=>$newConvergence->getCreator()->getUserToken()
            ];
        $convergenceResponse["friends"] = [];
        $invitations = $em->getRepository('AppBundle\Entity\Invitation')->findByConvergence($newConvergence);

        foreach($invitations as $invitation){
            $convergenceResponse["friends"][] =
                [   "pseudo"=>$invitation->getUser()->getPseudo(),
                    "image"=>$invitation->getUser()->getImage(),
                    "description"=>$invitation->getPublicDescription(),
                    "lat"=>0,//ici il faudra ajouter un chap lat, lng qui represente la derniere location du user
                    "lng"=>0
                ];
        }

        $jsonContent = $serializer->serialize($convergenceResponse, 'json');

        $response = new Response(json_encode($jsonContent));
        $response->headers->set('Content-Type', 'application/json');


        return $response;

    }


    /**
     * @Route("/convergence/update", name="update_convergence")
     */
    public function updateAction(Request $request){
        //if user token is creator token

    }
}
