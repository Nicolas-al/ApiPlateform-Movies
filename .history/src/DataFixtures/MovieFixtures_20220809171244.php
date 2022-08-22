<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        /** @var array<array-key, Genre> $genres */
        $genres = $manager->getRepository(Genre::class)->findAll();

        /** @var array<array-key, Person> $persons */
        $persons = $manager->getRepository(Person::class)->findAll();

        foreach($genres as $genre){
            for ($i = 1; $i <= 10; $i++) {
                $movie = (new Movie())
                        ->setTitle(sprintf('Titre %d', $i))
                        ->setSynopsis(sprintf('Synopsis %d', $i))
                        ->setDuration(rand(80, 300))
                        ->setProductionYear(rand(1970, 2022))
                        ->setGenre($genre);
                shuffle($persons);

                foreach(array_slice($persons, 0, 3) as $person){
                    $movie->getActors()->add($person);
                }
                foreach(array_slice($persons, 3, 2) as $person){
                    $movie->getDirectors()->add($person);
                }
            } 
        }
       

        $manager->flush();
    }
}
