<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 08/01/19
 * Time: 14:21
 */

namespace App\DataFixtures;

use App\Entity\LearningCenter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LearningCenterFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $word = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $learningCenter = new LearningCenter();
            $learningCenter->setName(ucfirst($word->word));
            $learningCenter->setPicture('defaultpicture.png');
            $learningCenter->setMail($word->email);
            $learningCenter->setLink($word->url);
            $learningCenter->setAccepted(true);
            $learningCenter->setUpdatedAt(new \DateTime());
            $manager->persist($learningCenter);
            $manager->flush();
        }
    }
}
