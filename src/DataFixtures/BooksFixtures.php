<?php

namespace App\DataFixtures;

use App\Entity\Books;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BooksFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 10; $i++) { 
            $book = new Books();
            $book->setTitle("Titre du livre n°$i")
                ->setAuthor("Auteur du livre n°$i")
                ->setDateEdition(new \DateTime())
                ->setDateAdd(new \DateTime());
            $manager->persist($book);
        }
        $manager->flush();
    }
}
