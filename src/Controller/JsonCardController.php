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
    #[Route("/api/deck", name: "api_deck")]
    public function deck(
        Request $request,
        SessionInterface $session
    ): Response {

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

    #[Route("/api/deck/shuffle", name: "api_shuffle")]
    public function shuffle(
        Request $request,
        SessionInterface $session
    ): Response {

        $deck = $session->get("deck");
        $deck-> shuffle();
        $session -> set("deck", $deck);
        $data = ["deck" => $session->get("deck")->getJsonStringArray()];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route("/api/deck/draw", name: "api_draw")]
    public function draw(
        Request $request,
        SessionInterface $session
    ): Response {
        $deck = $session -> get("deck");
        $remCards = $deck->getNumberCards();
        $drawn = $deck->getCard(52 - $remCards);
        $deck->remove(new Card(), 52 - $remCards);

        //$drawnCard = $deck[0];
        //$deck.slice(1);
        $session->set("deck", $deck);
        $updatedDeck = $session->get("deck", $deck);
        $data = [
            "Card" => $drawn->GetPrint(),
            "remCards" => $updatedDeck->getNumberCards(),
        ];


        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }

    #[Route("/api/deck/draw/{num<\d+>}", name: "api_draw_many")]
    public function draw_many(
        int $num,
        Request $request,
        SessionInterface $session
    ): Response {

        $hand = new CardHand();
        $deck = $session -> get("deck");

        for ($i = 1; $i <= $num; $i++) {

            $remCards = $deck->getNumberCards();
            $drawn = $deck->getCard(51 - $remCards + 1);
            $deck->remove(new Card(), 51 - $remCards + 1);

            $hand->add($drawn);
            $session->set("hand", $hand);
            // $card = new Card();
            // $card -> setValue();
            // $card -> setSuit();
        }

        $session->set("deck", $deck);
        $session->set("hand", $hand);

        $updatedDeck = $session->get("deck", $deck);
        $data = [
            "hand" => $session->get("hand")->getJsonStringArray(),
            "remainingCards" => $updatedDeck->getNumberCards(),
        ];

        //return $this->render('draw_many.html.twig', $data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        return $response;
    }



}
