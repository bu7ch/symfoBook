<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    $books = [
      ['1984', 'Georges Orwell', 1949, true],
      ['To Kill a Mockingbird', 'Harper Lee', 1960, false],
      ['The Great Gatsby', 'F.Scott Fitzgerald', 1925, true],
    ];
    foreach ($books as $data) {
      $book = new Book();
      $book->setTitle($data[0])
        ->setAuthor($data[1])
        ->setYear($data[2])
        ->setAvailable($data[3]);
      $manager->persist($book);
    }

    $manager->flush();
  }
}
