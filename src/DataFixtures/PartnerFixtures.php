<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 08/01/19
 * Time: 13:50
 */

namespace App\DataFixtures;

use App\Entity\Partner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PartnerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $word = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $partner = new Partner();
            $partner->setPicture('defaultpicture.png');
            $partner->setName(ucfirst($word->word));
            $partner->setUrl($word->url);
            $partner->setUpdatedAt(new \DateTime());
            $manager->persist($partner);
            $manager->flush();
        }
    }
}
