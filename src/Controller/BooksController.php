<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\BookType;
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
    #[Route('/books/{id}/edit', name: 'app_books_edit')]
    public function form(Books $book=null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$book){
            $book = new Books();
        }
        
        $form = $this->createForm(BookType::class, $book);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump('coucou');
            if(!$book->getId()){
                $book->setCreatedAt(new \DateTime());
            }else{
                $book->setUpdateAt(new \DateTime());
            }

            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('app_book_show', ['id' => $book->getId()]);

        };
        // dd($book);
        return $this->render('books/createBook.html.twig', [
            'form' => $form->createView(),
            // Bouléen, si ($book->getId() !== null) alors il existe, et EditMode sera true
            'editMode' => $book->getId() !== null
        ]);

    }

    /**
     * Book delete
     */
    #[Route('/book/delete/{id}', name: 'app_book_delete')]
    public function delete(Books $book, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('app_books_index');
    }

    /**
     * Fonction qui permet d'afficher les information d'un livre
     *
     * 
     * @return void
     */
    #[Route('/book/{id}', name: 'app_book_show')]
    // Ici grâce au ParamConverter, pas besoin de faire appel au repo avec l'id en paramètre
    public function show(Books $book){

        // $repo = $this->getDoctrine()->getRepository(Books::class);
        // $book = $booksRepository->find($id);
        // $book = $repo->find($id);

        return $this->render('books/show.html.twig', [
            'book' => $book,
        ]);
    }
}
