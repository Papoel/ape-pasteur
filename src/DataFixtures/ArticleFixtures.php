<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 20; ++$i) {
            $article = new Article();
            $article->setTitle($faker->sentence($faker->numberBetween(1, 3)));
            $article->setContent($faker->paragraphs(12, true));
            $article->setIsPublished($faker->boolean());
            $article->setVotes($faker->numberBetween(-100, 1000));
            $article->setDescription($faker->paragraphs(3, true));
            $article->setFile('placeholder.webp');

            $article->addCategory(
                $this->getReference(sprintf('category%s', $faker->numberBetween(1, 5)))
            );

            $article->setAuthor(
                $this->getReference(sprintf('author%d', $faker->numberBetween(1, 20)))
            );

            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
            UserFixtures::class,
        ];
    }
}
