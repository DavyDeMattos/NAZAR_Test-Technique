<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// use SymfonyComponentHttpFoundationResponse;
// use SymfonyComponentRoutingAnnotationRoute;

class MainController extends AbstractController
{
  /**
   * @route('/', name="app_homepage")
   * @return Response
   */
  #[Route('/', name: 'app_homepage')]
  public function index(): Response
  {
    return $this->render('main/index.html.twig', [
      'controller_name' => 'MainController',
    ]);
  }
}