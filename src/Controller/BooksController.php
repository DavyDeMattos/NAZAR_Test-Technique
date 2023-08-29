<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\AddBookForm;
use App\Repository\BooksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    #[Route('/books', name: 'app_books_index')]
    public function index(BooksRepository $booksRepository): Response
    {
        // $repo = $this->getDoctrine()->getRepository(Books::class);
        $books = $booksRepository->findAll();
        return $this->render('books/index.html.twig', [
            'controller_name' => 'BooksController',
            'books' => $books
        ]);
    }

    /**
     * Add a book in the BDD
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/books/add', name: 'app_books_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $book = new Books;

        $form = $this->createForm(AddBookForm::class, $book);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('books/createBook.html.twig', [
                'form' => $form->createView(),
            ]);
        }
        $book = $form->getData();

        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('app_books_index');
    }
}
