<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 08/01/19
 * Time: 11:08
 */

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class JobFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $word = Factory::create('fr_FR');
        for ($e = 0; $e < 2; $e++) {
            for ($i = 0; $i < 10; $i++) {
                $job = new Job();
                $job->setName(ucwords($word->word));
                $job->setDescription(ucfirst($word->text(200)));
                $job->setPicture('defaultjobpicture.png');
                $job->setAssociatedCategory(
                    $this->getReference('category_'.$i)
                );
                if ($e === 0) {
                    $job->setVideo('https://www.youtube.com/embed/UPDmfW9QIR0');
                    $job->setVideoDescription($word->text);
                    $job->setVideoTitle($word->word);
                }
                $this->addReference('job_'.$i.$e, $job);
                $manager->persist($job);
                $manager->flush();
            }

        }
    }
}
