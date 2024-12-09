<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/users')]
class UserController extends AbstractController
{
  #[Route('/', name: 'user_index', methods: ['GET'])]
  public function index(EntityManagerInterface $em): Response
  {
    $users = $em->getRepository(User::class)->findAll();
    return $this->render('user/index.html.twig', [
      'users' => $users,
    ]);
  }

  #[Route('/new', name: 'user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

  #[Route('/{id}', name: 'user_show', methods: ['GET'])]
  public function show(User $user): Response
  {
    return $this->render('user/show.html.twig', [
      'user' => $user
    ]);
  }
  #[Route('/{id}/edit', name: 'user_edit', methods: ['GET', 'POST'])]
  public function edit(Request $request, User $user, EntityManagerInterface $em): Response
  {
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em->flush();

      return $this->redirectToRoute('user_index');
    }

    return $this->render('user/edit.html.twig', [
      'form' => $form->createView(),
      'user' => $user,
    ]);
  }
  #[Route('/{id}', name: 'user_delete', methods: ['POST'])]
  public function delete(Request $request, User $user, EntityManagerInterface $em): Response
  {
    if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
      $em->remove($user);
      $em->flush();
    }

    return $this->redirectToRoute('user_index');
  }
}
