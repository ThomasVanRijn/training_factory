<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $manager->persist($this->user($i));
        }
        $manager->flush();
    }

    public function user($i)
    {
        $user = new User();
        $user->setEmail(sprintf('tester%d@gmail.com', $i));
        $user->setFirstname(sprintf('tester%d', $i));
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'wachtwoord'
        ));
        if ($i >= 2) {
            $role = array('ROLE_USER');
        } else {
            $role = array('ROLE_ADMIN');
        }
        $user->setRoles($role);
        return $user;
    }

}