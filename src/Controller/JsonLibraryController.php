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

class JsonLibraryController extends AbstractController
{
    #[Route('/api/library/books', name: 'jsonLibrary')]
    public function jsonLibrary(
        BooksRepository $booksRepository
    ): Response {
        $books = $booksRepository->getJsonStringArray($booksRepository->findAll());

        $response = new JsonResponse($books);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route('/api/library/books/{num}', name: 'libraryOne')]
    public function jsonLibraryOne(
        string $num,
        BooksRepository $booksRepository
    ): Response {
        $book = $booksRepository->findOneBy(['ibsn' => $num]);
        $data = [
            "ibsn" => $book->getIbsn(),
            "title" => $book->getTitle(),
            "Author" => $book->getAuthor(),
            "image" => $book->getImage(),

        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }
}
