<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 08/01/19
 * Time: 10:55
 */

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $word = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName(ucwords($word->word));
            $manager->persist($category);
            $manager->flush();
        }
    }
}