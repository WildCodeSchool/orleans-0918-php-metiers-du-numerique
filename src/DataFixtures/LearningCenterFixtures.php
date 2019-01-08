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
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LearningCenterFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $word = Factory::create('fr_FR');
        for ($e = 0; $e < 2; $e++) {
            for ($i = 0; $i < 10; $i++) {
                $learningCenter = new LearningCenter();
                $learningCenter->setName(ucfirst($word->word));
                $learningCenter->setPicture('defaultpicture.png');
                $learningCenter->setMail($word->email);
                $learningCenter->setLink($word->url);
                $learningCenter->addJob($this->getReference('job_' . $i . $e));
                $learningCenter->setAccepted(true);
                $learningCenter->setUpdatedAt(new \DateTime());
                $manager->persist($learningCenter);
                $manager->flush();
            }
        }
    }
    public function getDependencies()
    {
        return array(
            JobFixtures::class
        );
    }
}
