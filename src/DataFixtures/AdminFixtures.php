<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 08/01/19
 * Time: 14:24
 */

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AdminFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $word = Factory::create('fr_FR');
        $admin = new Admin();
        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword('$argon2i$v=19$m=1024,t=2,p=2$NEtxclBxYzgvY0dxVUo3Wg$6O5FHw+964F2SJPqJXrjU2xBid17y55F9dJnp8P9nG8');
        $manager->persist($admin);
        $manager->flush();
    }
}
