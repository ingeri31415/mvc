<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\DeckOfCards;
use App\Card\CardHand;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class MeControllerTwig extends AbstractController
{
    #[Route("/report", name: "report")]
    public function report(): Response
    {


        return $this->render('report.html.twig');
    }


    #[Route('/', name: "/")]
    public function hello(): Response
    {
        /*     return new Response(
            '<html><body>I am Ingrid </body></html>'
        ); */
        return $this->render('me.html.twig');
    }

    #[Route('/about', name: "about")]
    public function about(): Response
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

    #[Route("/session", name: "session")]
    public function home(
        SessionInterface $session,
        Request $request
    ): Response {
        $info = $request->getSession();
        $vars = [];
        foreach ($info as $inf) {
            $vars[] = $inf->getJsonString();
        }
        $data = [
            "info" => $vars,
        ];
        return $this->render('session.html.twig', $data);
    }

    #[Route("/session/delete", name: "session_delete")]
    public function sessionDelete(
        SessionInterface $session,
        Request $request
    ): Response {
        $session->clear();
        $this->addFlash(
            'warning',
            'You have deleted everything in this session'
        );
        return $this->redirectToRoute('session');
    }

    #[Route('/metrics', name: "metrics")]
    public function metrics(): Response
    {

        return $this->render('metrics.html.twig');
    }

    #[Route("/api", name: "api")]
    public function jsonNumber(
        SessionInterface $session
    ): Response {

        $data = [
            '/' => 'page about me',
            'about' => 'about this course',
            'report' => 'my reports',
            'lucky' => 'get your lucky number',
            'api' => 'this page over routes',
            'api/deck' => 'see the deck fully sorted',
            'api/
            ' => 'a new shuffled deck',
            'api/game' => 'the game scores'

        ];

        $deck = new DeckOfCards();
        for ($i = 1; $i <= 52; $i++) {
            $deck->add(new CardGraphic());
            $card = new Card();
        }

        $deck->getDeck();
        $session->set("deck", $deck);


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
