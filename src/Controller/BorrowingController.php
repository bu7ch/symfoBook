<?php

namespace App\Controller;

use App\Entity\Borrowing;
use App\Form\BorrowingType;
use App\Repository\BorrowingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

  #[Route('/new', name: 'borrowing_new', methods: ['GET', 'POST'])]
  public function new(Request $request, BorrowingRepository $borrowingRepository): Response {
    $borrowing = new Borrowing();
    $form = $this->createForm(BorrowingType::class, $borrowing);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $borrowingRepository->save($borrowing, true);
      return $this->redirectToRoute('borrowing_index');
    }
    return $this->render('borrowing/new.html.twig',[
      'form'=> $form->createView(),
    ]);
  }
}
