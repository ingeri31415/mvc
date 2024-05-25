<?php

namespace App\Controller;

use App\Entity\Books;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BooksRepository;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }
    #[Route('/library', name: 'library')]
    public function library(
    ): Response {


        return $this->render('book/library.html.twig');
    }

    #[Route('/library/creater', name: 'book_creater')]
    public function createBook(
        Request $request,
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();

        $book = new Books();
        $book->setTitle($request->get('title'));
        $book->setImage($request->get('image'));
        $book->setAuthor($request->get('author'));
        $book->setIbsn($request->get('ibsn'));

        // tell Doctrine you want to (eventually) save the Product
        // (no queries yet)
        $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        $this->addFlash(
            'warning',
            'You have added a new book'
        );
        return $this->redirectToRoute('book_create');
    }

    #[Route('/library/create', name: 'book_create')]
    public function create(
    ): Response {
        //$entityManager = $doctrine->getManager();

        //$book = new Books();
        //$book->setName('Keyboard_num_' . rand(1, 9));
        //$book->setValue(rand(100, 999));

        // tell Doctrine you want to (eventually) save the Product
        // (no queries yet)
        //$entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        //$entityManager->flush();
        return $this->render('book/create.html.twig');
    }

    #[Route('/library/show', name: 'show')]
    public function showAllBooks(
        BooksRepository $booksRepository
    ): Response {
        $books = $booksRepository->findAll();
        $data = [
            "books" => $books
        ];
        return $this->render('book/show.html.twig', $data);
    }

    #[Route('/library/show/{num}', name: 'show_one')]
    public function showOneBook(
        string $num,
        BooksRepository $booksRepository
    ): Response {
        $books = $booksRepository->findOneBy(['ibsn' => $num]);
        $data = [
            "books" => $books
        ];
        return $this->render('book/showOne.html.twig', $data);
    }

    #[Route('/library/delete/{id}', name: 'deleteing')]
    public function deleteBook(
        ManagerRegistry $doctrine,
        BooksRepository $booksRepository,
        string $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $booksRepository->findOneBy(['ibsn' => $id]);//
        //$book = $entityManager->getRepository(Books::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'Cannot find a book with this IBSN '.$id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('delete');
    }

    #[Route('/library/delete', name: 'delete')]
    public function delete(
        BooksRepository $booksRepository,
    ): Response {

        $books = $booksRepository->findall();
        $data = [
            "books" => $books
        ];
        return $this->render('book/delete.html.twig', $data);
    }

    #[Route('/product/updateer/{id}', name: 'updateer')]
    public function updateBook(
        ManagerRegistry $doctrine,
        Request $request,
        string $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Books::class)->findOneBy(['ibsn' => $id]);

        if (!$book) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $book->setIbsn($request->get('ibsn'));
        $book->setTitle($request->get('title'));
        $book->setImage($request->get('image'));
        $book->setAuthor($request->get('author'));
        $entityManager->flush();

        return $this->redirectToRoute('show');
    }

    #[Route('/library/update/{id}', name: 'update')]
    public function update(
        BooksRepository $booksRepository,
        string $id
    ): Response {
        $book = $booksRepository->findOneBy(['ibsn' => $id]);
        $data = [
            "book" => $book
        ];
        return $this->render('book/update.html.twig', $data);
    }


}
