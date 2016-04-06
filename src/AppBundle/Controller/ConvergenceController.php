<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Convergence;
use AppBundle\Entity\Invitation;
use AppBundle\Controller\OptionOkInterface;
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
        $convergenceResponse = null;

        $em = $this->get('doctrine')->getManager();
        $serializer = $this->container->get('serializer');

        $content = $request->getContent();

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
            $newCreator->setLat($creator['lat']);
            $newCreator->setLng($creator['lng']);
            $newCreator->setLocationUpdateDate(new \DateTime());
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

            $convergenceResponse = $this->getConvergenceDetail($newConvergence, $newCreator);
            $userResponse = $this->getUserDetail($newCreator);

        }

        $convergenceAndUserResponse['user'] = $userResponse;
        $convergenceAndUserResponse['convergence'] = $convergenceResponse;
        $jsonContent = $serializer->serialize($convergenceAndUserResponse, 'json');

        $response = new Response(json_encode($jsonContent));
        $response->headers->set('Content-Type', 'application/json');


        return $response;

    }


    /**
     * @Route("/convergence/invitation/{code}", name="convergece_by_invitation")
     */
    public function convergenceByCodeAction($code){
        $em = $this->get('doctrine')->getManager();
        $serializer = $this->container->get('serializer');

        $invitation = $em->getRepository('AppBundle:Invitation')
            ->findOneBy(array("token"=>$code));

        $user = $invitation->getUser();
        $userResponse = $this->getUserDetail($user);

        $convergence = $invitation->getConvergence();
        $convergenceResponse = $this->getConvergenceDetail($convergence, $user);

        $convergenceAndUserResponse['user'] = $userResponse;
        $convergenceAndUserResponse['convergence'] = $convergenceResponse;
        $jsonContent = $serializer->serialize($convergenceAndUserResponse, 'json');

        $response = new Response(json_encode($jsonContent));
        $response->headers->set('Content-Type', 'application/json');


        return $response;

    }

    /**
     * @Route("/convergence/{id}", name="convergece_by_id")
     */
    public function convergenceByIdAction(Request $request, $id){
        $em = $this->get('doctrine')->getManager();
        $serializer = $this->container->get('serializer');

        $convergence = $em->getRepository('AppBundle:Convergence')
            ->findOneBy(array("id"=>$id));

        $content = $request->getContent();

        if (!empty($content)) {
            $params = json_decode($content, true);
            $userToken = $params['userToken'];
            $user = $em->getRepository('AppBundle:User')
                ->findOneBy(array("userToken"=>$userToken));
            $convergenceResponse = $this->getConvergenceDetail($convergence, $user);
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

    private function getConvergenceDetail($convergence, $currentUser){

        $em = $this->get('doctrine')->getManager();

        $convergenceResponse = [
            "id"=>$convergence->getId(),
            "name"=>$convergence->getName(),
            "description"=>$convergence->getDescription(),
            "tags"=>$convergence->getTags()];

        $convergenceResponse['place'] =[];
        $convergenceResponse['place']['googlePlace'] = $convergence->getPlace()->getGooglePlaceJson();
        $convergenceResponse['place']['name'] = $convergence->getPlace()->getName();
        $convergenceResponse['place']['lat'] = $convergence->getPlace()->getLat();
        $convergenceResponse['place']['lng'] = $convergence->getPlace()->getLng();
        $convergenceResponse['creator'] =
            [
                "pseudo"=>$convergence->getCreator()->getPseudo(),
                "firstname"=>$convergence->getCreator()->getFirstname(),
                "lastname"=>$convergence->getCreator()->getLastname(),
            ];

        $convergenceResponse["friends"] = [];

        $invitations = $em->getRepository('AppBundle\Entity\Invitation')->findByConvergence($convergence);

        foreach($invitations as $invitation){
            $isCurrentUser = ($invitation->getUser()->getId() == $currentUser->getId());
            $convergenceResponse["friends"][] =
                [   "pseudo"=>$invitation->getUser()->getPseudo(),
                    "image"=>$invitation->getUser()->getImage(),
                    "description"=>$invitation->getPublicDescription(),
                    "lat"=>$invitation->getUser()->getLat()?$invitation->getUser()->getLat():0,
                    "lng"=>$invitation->getUser()->getLng()?$invitation->getUser()->getLng():0,
                    "locationUpdateDate"=>$invitation->getUser()->getLocationUpdateDate(),
                    "isCreator"=>false,
                    "isCurrentUser"=>$isCurrentUser
                ];
        }

        $convergenceResponse["friends"][] = [
                    "pseudo"=>$convergence->getCreator()->getPseudo(),
                    "image"=>$convergence->getCreator()->getImage(),
                    "description"=>"",
                    "lat"=>$convergence->getCreator()->getLat()?$convergence->getCreator()->getLat():0,
                    "lng"=>$convergence->getCreator()->getLng()?$convergence->getCreator()->getLng():0,
                    "locationUpdateDate"=>$convergence->getCreator()->getLocationUpdateDate(),
                    "isCreator"=>true,
                    "isCurrentUser"=>$convergence->getCreator()->getId() == $currentUser->getId()
                ];

        return $convergenceResponse;
    }

    private function getUserDetail($user){

        $userResponse =
            [   'pseudo' => $user->getPseudo() ,
                'userToken' =>$user->getUserToken() ,
                'email' => $user->getEmail() ,
                'firstname' =>  $user->getFirstname() ,
                'lastname' => $user->getLastname() ,
                'image' => $user->getImage() ,
                'phone' => $user->getPhone() ,
                'lat' => $user->getLat()?$user->getLat():0,
                'lng' => $user->getLng()?$user->getLng():0,
                'locationUpdateDate' => $user->getLocationUpdateDate()
            ];

        return $userResponse;
    }
}
