<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

   
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;

    }

    public function load(ObjectManager $manager)
    {
        $role1 = new Role();
        $role1->setLibelle("ROLE_SUPER_ADMIN");
        $role2 = new Role();
        $role2->setLibelle("ROLE_ADMIN");
        $role3 = new Role();
        $role3->setLibelle("ROLE_CAISSIER");
        

        $user = new User();
        $user->setNomComplet("pierre");
        $user->setEmail("pierre@gmail.com");
        $user->setPassword($this->passwordEncoder->encodePassword($user,'123'));

        $user->setRoles(["ROLE_SUPER_ADMIN"]);
        $user->setRole($role1);
        $user->setIsActive(true);


        $manager->persist($role1);
        $manager->persist($role2);
        $manager->persist($role3);

        $manager->persist($user);
        $manager->flush();
    }
}

