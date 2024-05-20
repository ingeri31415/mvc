<?php

namespace App\Controller;

use App\Dice\Dice;
use App\Dice\DiceGraphic;
use App\Dice\DiceHand;
use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\DeckOfCards;
use App\Card\CardHand;
use App\Card\Player;
use App\Card\Game;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route("/game", name: "game")]
    public function game(
        SessionInterface $session
    ): Response {
        $deck = new DeckOfCards();
        for ($i = 1; $i <= 52; $i++) {
            $deck->add(new CardGraphic());
        }

        $deck->getDeck();
        $deck-> shuffle();
        $session->set("deck", $deck);
        // $player1 = new Player();
        // $bank = new Player();
        // $session->set("player1", $player1);
        // $session->set("bank", $bank);
        $game = new Game();
        $game->addPlayer(new Player());
        $game->addPlayer(new Player());
        $session->set("game", $game);
        $playerHand = new CardHand();
        $session->set("player_hand", $playerHand);


        $data = [
            "bank" => $session->get("game")->getBank(),
            "player1" => $session->get("game")->getPlayer(),
        ];

        return $this->render('game.html.twig', $data);
    }

    #[Route("/game_play", name: "game_play")]
    public function gamePlay(
        SessionInterface $session
    ): Response {
        $data = [
            "drawn" => "You've not drawn any cards yet",
            "score" => $session->get("game")->getPlayer()->getScore(),
        ];
        return $this->render('game_play.html.twig', $data);
    }

    #[Route("/draw_card", name: "draw_card")]
    public function drawCard(
        SessionInterface $session
    ): Response {
        $deck = $session->get("deck");
        $remCards = $deck->getNumberCards();
        $drawn = $deck->getCard(52 - $remCards);
        $deck->remove(new Card(), 52 - $remCards);
        // $player1=$session->get("player1");
        // $player1->add_to_score($drawn->getValue());
        // $session->set("player1", $player1);
        $game = $session->get("game");
        $game->getPlayer()->addToScore($drawn->getValue());
        //$game -> $session->set("game");
        $session->set("game", $game);
        $hand = $session->get("player_hand");
        $hand->add($drawn);
        $session->set("player_hand", $hand);

        if ($game->getPlayer()->getScore() > 21) {
            //return $this->redirectToRoute('end_game');
            $data = [
                "bank_score" => "",
                "player_score" => $session->get("game")->getPlayer()->getScore(),
                "bank_hand" => "",
                "player_hand" => $session->get("player_hand")->getStringArray(),
                "winner" => $session->get("game")->winner(),
            ];
            return $this->render('results.html.twig', $data);
        }

        $data = [
            "drawn" => $drawn->GetPrint()[0],
            "score" => $session->get("game")->getPlayer()->getScore(),
        ];
        return $this->render('game_play.html.twig', $data);
    }

    #[Route("/end_game", name: "end_game")]
    public function results(
        SessionInterface $session
    ): Response {
        $hand = new CardHand();
        $deck = $session -> get("deck");
        $game = $session->get("game");

        while($game->getBank()->getScore() < 17) {
            $remCards = $deck->getNumberCards();
            $drawn = $deck->getCard(51 - $remCards + 1);
            $deck->remove(new Card(), 51 - $remCards + 1);
            $game->getBank()->addToScore($drawn->getValue());
            $hand->add($drawn);
            $session->set("hand", $hand);
        }
        $data = [
            "bank_score" => $session->get("game")->getBank()->getScore(),
            "player_score" => $session->get("game")->getPlayer()->getScore(),
            "bank_hand" => $session->get("hand")->getStringArray(),
            "player_hand" => $session->get("player_hand")->getStringArray(),
            "winner" => $session->get("game")->winner(),
        ];

        return $this->render('results.html.twig', $data);
    }

    #[Route("/api/game", name: "api_game")]
    public function apiGame(
        SessionInterface $session
    ): Response {
        $data = [
            "player_score" => $session->get("game")->getPlayer()->getScore(),
            "bank_score" => $session->get("game")->getBank()->getScore(),
        ];
        return new JsonResponse(
            $data
        );
    }

    #[Route("/game/doc", name: "gamedoc")]
    public function gameDoc(
    ): Response {
        return $this->render('doc.html.twig');
    }
}
