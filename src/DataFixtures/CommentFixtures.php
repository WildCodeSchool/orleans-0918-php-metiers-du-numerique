<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 08/01/19
 * Time: 11:01
 */

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $word = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $comment = new Comment();
            $comment->setFirstname($word->firstName);
            $comment->setLastname($word->lastName);
        }
    }
}