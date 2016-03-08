<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Place;

class LoadPlaceData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager){

        $googlePlace ='{\"address_components\":[{\"long_name\":\"Tizi Ouzou\",\"short_name\":\"Tizi Ouzou\",\"types\":[\"locality\",\"political\"]},{\"long_name\":\"Tizi Ouzou\",\"short_name\":\"Tizi Ouzou\",\"types\":[\"administrative_area_level_1\",\"political\"]},{\"long_name\":\"Algérie\",\"short_name\":\"DZ\",\"types\":[\"country\",\"political\"]},{\"long_name\":\"15000\",\"short_name\":\"15000\",\"types\":[\"postal_code\"]}],\"adr_address\":\"<span class=\\"locality\\">Tizi Ouzou</span> <span class=\\"postal - code\\">15000</span>, <span class=\\"country - name\\">Algérie</span>\",\"formatted_address\":\"Tizi Ouzou 15000, Algérie\",\"geometry\":{\"location\":{\"lat\":36.7021906,\"lng\":4.0593255},\"viewport\":{\"south\":36.6438373,\"west\":3.97589210000001,\"north\":36.7565764,\"east\":4.175083599999994}},\"icon\":\"https://maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png\",\"id\":\"d85bf3209ce3956941f0110396d0100caff9e243\",\"name\":\"Tizi Ouzou\",\"place_id\":\"ChIJCwn9v9_HjRIRBAgg3CCazSc\",\"reference\":\"CoQBdwAAAGCR9iFT0caS8p5X7DyEvRT9OqBOT-BflaZZMV2hDOgwo_n4Ld0jSvRWSkKuwehZIzqJhYpMutom7DAQfOP08g343a4lhDZNDJ2csU9z_j9m-tciViJeJT-CwW0JuK8KVLlK6MoSyT58gTzvXoUR9tdf-BryDaRN8Km-Rd67nFwvEhCVys3MHx03lsPnFspfvtpmGhQ5tOwd_sIxemSN9TbeEAB89gjBBQ\",\"scope\":\"GOOGLE\",\"types\":[\"locality\",\"political\"],\"url\":\"https://maps.google.com/?q=Tizi+Ouzou+15000,+Alg%C3%A9rie&ftid=0x128dc7dfbffd090b:0x27cd9a20dc200804\",\"vicinity\":\"Tizi Ouzou\",\"html_attributions\":[]}';

        $hakim = $this->getReference('user-hakim');

        $place = new Place();
        $place->setCreator($hakim);
        $place->setLat('36.7021906');
        $place->setLng('4.0593255');
        $place->setName('Tizi Ouzou');
        $place->setGooglePlaceJson($googlePlace);

        $manager->persist($place);
        $manager->flush();

        $this->addReference('place-1', $place);
    }

    public function getOrder(){
        return 2;
    }

}
