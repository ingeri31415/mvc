<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeControllerTwig extends AbstractController
{
    #[Route("/report", name: "report")]
    public function report(): Response
    {


        return $this->render('report.html.twig');
    }


    #[Route('/', name: "/")]
    public function hi(): Response
    {
        /*     return new Response(
            '<html><body>I am Ingrid </body></html>'
        ); */
        return $this->render('me.html.twig');
    }

    #[Route('/about', name: "about")]
    public function About(): Response
    {

        /*     return new Response(
                '<html><body>This is the mvc course</body></html>'
            ); */
        return $this->render('about.html.twig');
    }


    #[Route('/lucky', name: "lucky")]
    public function number(): Response
    {
        $number = random_int(0, 100);
        $data = [
            'number' => $number
        ];
        /*     return new Response(
                '<html><body>Lucky number: '.$number.'</body></html>'
            ); */
        return $this->render('lucky.html.twig', $data);
    }

    #[Route("/api", name: "api")]
    public function jsonNumber(): Response
    {
        $number = random_int(0, 100);

        $data = [
            '/' => 'page about me',
            'about' => 'about this course',
            'report' => 'my reports',
            'lucky' => 'get your lucky number',
            'api' => 'this page over routes',
            'api/deck' => 'see the deck fully sorted',
            'api/shuffle' => 'a new shuffled deck',
            'api/game' => 'the game scores'

        ];

        //return new JsonResponse($data);
        // $response = new JsonResponse($data);
        // $response->setEncodingOptions(
        //     $response->getEncodingOptions() | JSON_PRETTY_PRINT
        // );
        // return $response;
        return $this->render('api.html.twig', $data);
    }

    #[Route("/api/quote", name: "api/quote")]
    public function quote(): Response
    {
        $number = random_int(0, 2);
        $date = date('l jS \of F Y h:i:s A');
        $quotes = ['You shall not pass', 'may the odds be ever in your favour','bowties are cool'];
        $data = ['Quote of the day' => $quotes[$number],
            'Date' => $date];

        return new JsonResponse(
            $data
        );
    }

}
