<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 08/01/19
 * Time: 14:10
 */

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CompanyFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $word = Factory::create('fr_FR');
        for ($e = 0; $e < 2; $e++) {
            for ($i = 0; $i < 10; $i++) {
                $company = new Company();
                $company->setName(ucfirst($word->word));
                $company->setPicture('defaultpicture.png');
                $company->setMail($word->email);
                $company->setLink($word->url);
                $company->setAccepted(true);
                $company->setUpdatedAt(new \DateTime());
                $company->addJob($this->getReference('job_' . $i . $e));
                $manager->persist($company);
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
