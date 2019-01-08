<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 08/01/19
 * Time: 11:01
 */

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $word = Factory::create('fr_FR');
        for ($e = 0; $e < 2; $e++) {
            for ($i = 0; $i < 5; $i++) {
                $comment = new Comment();
                $comment->setFirstname(ucwords($word->firstName));
                $comment->setLastname(ucwords($word->lastName));
                $comment->setAssociatedJob(
                    $this->getReference('job_' . $i.$e)
                );
                $comment->setPicture('defaultpicture.png');
                $comment->setMail($word->email);
                $comment->setUpdatedAt($word->dateTime);
                $comment->setLiked(rand(0, 5));
                $comment->setAccepted(true);
                $comment->setPostDate(new \DateTime());
                $comment->setJob($word->word);
                $comment->setCompany($word->text);
                $comment->setComment(ucfirst($word->text));
                $comment->setConsComment(ucfirst($word->text));
                $comment->setProsComment(ucfirst($word->text));
                $manager->persist($comment);
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
