<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {}

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $users = [];
        $user = new User();
        $user->setEmail('admin@email.fr');
        $user->setRoles(['ROLE_ADMIN']);
        $hash = $this->passwordHasher->hashPassword($user, ('password'));
        $user->setPassword($hash);
        $user->setFirstname('pascal');
        $user->setLastname('briffard');
        $user->setAddress('15 rue de la Liberté');
        $user->setPostalCode('59600');
        $user->setTown('Maubeuge');
        $user->setIsValide(true);
        $user->setPseudo('Papoel');

        $manager->persist($user);
        $users[] = $user;

        // ? Création de 20 comptes utilisateurs
        for ($i = 1; $i <= 50; $i++) {
            $users = [];
            $user = new User();
            $user->setEmail('user' .$i. '@email.fr');
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
            $user->setFirstname($faker->firstname());
            $user->setLastname($faker->lastname());
            $user->setAddress($faker->address());
            $user->setPostalCode($faker->randomNumber(5, true));
            $user->setTown($faker->city());
            $user->setIsValide($faker->boolean());
            $user->setPseudo($faker->Name() ."-". $faker->randomNumber(2, false));

            $manager->persist($user);
            $users[] = $user;
        }

        $manager->flush();
    }
}
