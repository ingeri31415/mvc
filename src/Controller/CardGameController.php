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

class CardGameController extends AbstractController
{
    #[Route("/session", name: "session")]
    public function home(        
        Request $request,
        SessionInterface $session
    ): Response
    {
        $data = [
            "session" => $session,

        ]; 

        return $this->render('session.html.twig', $data);
    }
    #[Route("/session/delete", name: "session_delete")]
    public function session_delete(): Response
    {
        $this->addFlash(
            'warning',
            'You have deleted everything in this session'
        );
        return $this->render('session.html.twig');
    }

    #[Route("/card", name: "card")]
    public function card(        
        Request $request,
        SessionInterface $session
    ): Response
    {
        $card = new Card();
        // $card->setValue();
        // $card->setSuit();

        // $data = [
        //     "cardValue" => $card->getValue(),
        //     "cardSuit" => $card->getSuit(),
        //     //"cardString" => $card->getAsString(),
        // ];

        $deck = new DeckOfCards();
        $deckie=[];
        $test = "bye";
        for ($i = 1; $i <= 52; $i++) {
            $deck->add(new Card());
            $card = new Card();
            $card -> setValue();
            $card -> setSuit();
            //$deckie[]=$card->getAsString();

            $test = $i;
        }
        
        $deck->getDeck();
        $test2 = $deck->getNumberCards();
        //$deck->getDeck();
        $session->set("deck", $deck);


        $data = [
            "cardValue" => $card->setValue(),
            "cardSuit" => $card->setSuit(),
            "cardValueString" => $card->getValueAsString(),
            "cardSuit" => $card->getSuit(),
            "deck" => $deck->getStringArray(),
        ];

        return $this->render('card.html.twig', $data);
    }

    #[Route("/card/deck", name: "deck")]
    public function deck(
        Request $request,
        SessionInterface $session
    ): Response
    {
        $deck = $session->get("deck");
        $deck->sort();
        $session -> set("deck", $deck);
        //$deckString = $deck->getStringArray();
        $data = [
            //"deckie" => $deckie,
            //"greeting" => $test,
            //"deck" => $deck->getStringArray(),
            //"number" => $test2,
            "deck" => $session->get("deck")->getStringArray(),

        ];

        
        return $this->render('deck.html.twig', $data);
    }

    #[Route("/card/deck/shuffle", name: "shuffle")]
    public function shuffle(
        Request $request,
        SessionInterface $session
    ): Response
    {

        $deck = $session -> get("deck");
        $deck-> shuffle();
        $session -> set("deck", $deck);
        $data = [
            "deck" => $session->get("deck")->getStringArray(),

        ];

        
        return $this->render('deck.html.twig', $data);
    }

    #[Route("/card/deck/draw", name: "draw")]
    public function draw(
        Request $request,
        SessionInterface $session
    ): Response
    {
        $deck = $session -> get("deck");
        $remCards = $deck->getNumberCards();
        $drawn = $deck->getCard(52-$remCards);
        $deck->remove(new Card(), 52-$remCards);
        
        //$drawnCard = $deck[0];
        //$deck.slice(1);
        $session->set("deck", $deck);
        $updatedDeck = $session->get("deck", $deck);
        $data = [
            "drawnSuit" => $drawn->GetSuit(),
            "drawnValue" => $drawn->GetValue(),

            "deck" => $session->get("deck", $deck),
            "remCards" => $updatedDeck->getNumberCards(),

        ];

        
        return $this->render('draw.html.twig', $data);
    }

    #[Route("/deck/hand", name: "init_hand", methods: ['GET'])]
    public function init(): Response
    {
        return $this->render('init_hand.html.twig');
    }

    #[Route("/deck/hand", name: "init_hand_post", methods: ['POST'])]
    public function initCallback(
        Request $request,
        SessionInterface $session
    ): Response
    {
        $numDice = $request->request->get('num_cards');
        $data = [
            
        ];

        return $this->redirectToRoute('/card/deck/draw/${ numDice }', $data);
    }

    #[Route("/card/deck/draw/{num<\d+>}", name: "draw_many")]
    public function draw_many(
        int $num,
        Request $request,
        SessionInterface $session
    ): Response
    {

        $hand = new CardHand();
        $deck = $session -> get("deck");
       
        for ($i = 1; $i <= $num; $i++) {

            $remCards = $deck->getNumberCards();
            $drawn = $deck->getCard(51-$remCards+1);
            $deck->remove(new Card(), 51-$remCards+1);

            $hand->add($drawn);
            $session->set("hand", $hand);
            // $card = new Card();
            // $card -> setValue();
            // $card -> setSuit();
        }


        



        
        //$drawnCard = $deck[0];
        //$deck.slice(1);
        $session->set("deck", $deck);
        $session->set("hand", $hand);

        $updatedDeck = $session->get("deck", $deck);
        $data = [
            "drawnSuit" => $drawn->GetSuit(),
            "drawnValue" => $drawn->GetValueAsString(),

            "deck" => $session->get("deck", $deck),
            "hand" => $session->get("hand")->getStringArray(),
            "remCards" => $updatedDeck->getNumberCards(),
        ];

        return $this->render('draw_many.html.twig', $data);
    }
}