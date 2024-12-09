<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Borrowing;
use App\Entity\User;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    $book1 = new Book();
    $book1->setTitle('1984')->setAuthor('George Orwell')->setYear(1949)->setAvailable(true);
    $manager->persist($book1);

    $book2 = new Book();
    $book2->setTitle('To Kill a Mockingbird')->setAuthor('Harper Lee')->setYear(1960)->setAvailable(false);
    $manager->persist($book2);

    $user1 = new User();
    $user1->setName('Alice')->setEmail('alice@exemple.com');
    $manager->persist($user1);

    $borrowing = new Borrowing();
    $borrowing->setBook($book1)->setUser($user1)->setBorrowedAt(new DateTime('-7 days'))->setReturnedAt(new DateTime('-2 days'));

    $manager->persist($borrowing);

    $manager->flush();
  }
}
