<?php
namespace App\Controller;

use App\Dice\Dice;
use App\Dice\DiceGraphic;
use App\Dice\DiceHand;
use App\Card\Card;
use App\Card\DeckOfCards;
use App\Card\CardHand;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class JsonCardController extends AbstractController
{
    #[Route("/api/deck", name: "api/deck")]
    public function deck(
        Request $request,
        SessionInterface $session
    ): Response
    {

        $deck = $session->get("deck");
        $deck->sort();
        $session -> set("deck", $deck);
        $data = ["deck" => $session->get("deck")->getJsonStringArray()];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route("/api/shuffle", name: "api/shuffle")]
    public function shuffle(
        Request $request,
        SessionInterface $session
    ): Response
    {

        $deck = $session->get("deck");
        $session -> set("deck", $deck);
        $data = ["deck" => $session->get("deck")->getJsonStringArray()];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }
}

