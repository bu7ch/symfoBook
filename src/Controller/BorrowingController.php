<?php

namespace App\Controller;

use App\Repository\BorrowingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BorrowingController extends AbstractController
{
    #[Route('/borrowings', name: 'borrowing_index')]
    public function index(BorrowingRepository $repository): Response
    {
      $borrowings = $repository->findAll();
        return $this->render('borrowing/index.html.twig', [
            'borrowings' => $borrowings,
        ]);
    }
}
