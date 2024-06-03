<?php

namespace App\Controller;

use App\Item\Item;
use App\Item\Backpack;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProjectGameController extends AbstractController
{
    #[Route("/proj", name: "proj")]
    public function proj(
        SessionInterface $session
    ): Response {
        $bp = new backpack();



        $message = "";
        $session->set("last", "proj");
        $session->set("message", $message);
        $session->set("bp", $bp);
        return $this->render('project/project.html.twig');
    }

    #[Route("/proj/entrance", name: "ent")]
    public function entrance(
        SessionInterface $session
    ): Response {
        $session->set("last", "entrance");
        $session->set("message", "There will always be an apple in this room");
        $data = [
            "message" => $session->get("message"),
            "names" => $session->get("bp")->getString(),
            "number" => $session->get("bp")->getNumberItems(),
        ];
        return $this->render('project/entrance.html.twig', $data);
    }

    #[Route("/proj/lib", name: "lib")]
    public function lib(
        SessionInterface $session
    ): Response {
        $session->set("last", "library");
        $session->set("message", "Look at all these books");

        $data = [
            "message" => $session->get("message"),
            "names" => $session->get("bp")->getString(),
        ];
        return $this->render('project/library.html.twig', $data);
    }

    #[Route("/proj/sitting", name: "sitting")]
    public function sitting(
        SessionInterface $session
    ): Response {
        $session->set("last", "sitting");
        $session->set("message", "Notes usually hold some value");
        $data = [
            "message" => $session->get("message"),
            "names" => $session->get("bp")->getString(),
        ];
        return $this->render('project/sitting.html.twig', $data);
    }

    #[Route("/proj/hallway", name: "hall")]
    public function hall(
        SessionInterface $session
    ): Response {
        $session->set("last", "hallway");
        $session->set("message", "you need to get through the door");
        $data = [
            "message" => $session->get("message"),
            "names" => $session->get("bp")->getString(),
        ];
        return $this->render('project/hallway.html.twig', $data);
    }

    #[Route("/proj/secret", name: "secret")]
    public function secret(
        Request $request,
        SessionInterface $session
    ): Response {
        $session->set("last", "secret");
        $bp = $session->get("bp")->getString();

        if (str_contains($request->get('comp'), "fantastic")) {
            $session->set("message", "you will need a key to open that chest");
            $data = [
                "message" => $session->get("message"),
                "names" => $bp,
            ];

            return $this->render('project/secret.html.twig', $data);
        }
        $session->set("message", "The troll rejected you compliment");
        $data = [
            "message" => $session->get("message"),
            "names" => $bp,
        ];
        return $this->render('project/hallway.html.twig', $data);
    }

    #[Route("/proj/pick_up/apple", name: "pick")]
    public function pick(
        SessionInterface $session,
    ): Response {

        $bp = $session->get("bp")->getString();
        if (in_array("apple", $bp)) {
            $session->set("message", "You have already picked up the apple");
            $data = [
                "message" => $session->get("message"),
                "names" => $session->get("bp")->getString(),
            ];
            return $this->render('project/entrance.html.twig', $data);
        }

        $message = " apple was picked up";
        $session->set("message", $message);
        $bp = $session->get("bp");
        $item = new Item();
        $item->setApple();
        $bp->add($item);
        $session->set("bp", $bp);
        $data = [
            "message" => $session->get("message"),
            "names" => $session->get("bp")->getString(),
        ];

        return $this->render('project/entrance.html.twig', $data);
    }

    #[Route("/proj/pick_up/book", name: "bookpick")]
    public function bookpick(
        SessionInterface $session,
    ): Response {
        $bp = $session->get("bp");
        $bpS = $session->get("bp")->getString();
        if (in_array("book", $bpS)) {
            $session->set("message", "You have already picked up the books");
            $data = [
                "message" => $session->get("message"),
                "names" => $session->get("bp")->getString(),
            ];
            return $this->render('project/library.html.twig', $data);
        }

        $message = "you picked up the books";
        $session->set("message", $message);

        $item = new Item();
        $item->setBook("book", "You look fantastic today");
        $bp->add($item);
        $item = new Item();
        $item->setBook("book", "Trolls will eat anything");
        $bp->add($item);
        $session->set("bp", $bp);
        $data = [
            "message" => $session->get("message"),
            "names" => $session->get("bp")->getString(),
        ];

        return $this->render('project/library.html.twig', $data);
    }

    #[Route("/proj/pick_up/note", name: "notepick")]
    public function notepick(
        SessionInterface $session,
    ): Response {
        $bp = $session->get("bp");
        $bpS = $session->get("bp")->getString();
        if (in_array("note", $bpS)) {
            $session->set("message", "You have already picked up the note");
            $data = [
                "message" => $session->get("message"),
                "names" => $session->get("bp")->getString(),
            ];
            return $this->render('project/sitting.html.twig', $data);
        }

        $message = "you picked up the note";
        $session->set("message", $message);

        $item = new Item();
        $item->setBook("note", "All compliments needs to contain the word fantastic");
        $bp->add($item);
        $session->set("bp", $bp);
        $data = [
            "message" => $session->get("message"),
            "names" => $session->get("bp")->getString(),
        ];

        return $this->render('project/sitting.html.twig', $data);
    }

    #[Route("/proj/eat/{num}", name: "eat")]
    public function eat(
        int $num,
        SessionInterface $session
    ): Response {
        $bp = $session->get("bp");
        $item = $bp->getItem($num);
        $message = $item->eat();
        $session->set("message", $message);
        if ($item->info() == "apple") {
            $bp->remove($num);
            $bp = $session->get("bp");
            $item = new Item();
            $item->setKey();
            $bp->add($item);
            $session->set("bp", $bp);

        }
        $session->set("bp", $bp);

        $data = [
            "message" => $message, //$session->get("message"),
            "names" => $session->get("bp")->getString(),
        ];
        $next = "project/" . $session->get("last")  . ".html.twig";
        return $this->render($next, $data);
    }

    #[Route("/proj/read/{num}", name: "read")]
    public function read(
        int $num,
        SessionInterface $session
    ): Response {
        $bp = $session->get("bp");
        $item = $bp->getItem($num);
        $message = $item->read();
        $session->set("message", $message);
        $session->set("bp", $bp);

        $data = [
            "message" => $message, //$session->get("message"),
            "names" => $session->get("bp")->getString(),
            "number" => $session->get("bp")->getNumberItems(),
        ];
        $next = "project/" . $session->get("last")  . ".html.twig";
        return $this->render($next, $data);
    }

    #[Route("/proj/give/{num}", name: "give")]
    public function give(
        int $num,
        SessionInterface $session
    ): Response {
        $bp = $session->get("bp");
        $item = $bp->getItem($num);
        $message = $item->give();
        $name = $item->info();

        $messageadd = ($name == "apple") ? "You heard a clinking sound" : " " ;

        if ($session->get("last") == "hallway") {
            $message = "You gave the " . $name . " to the troll and the troll ate it " . $messageadd;
            $bp->remove($num);
            $bp = $session->get("bp");
        }

        $session->set("message", $message);
        $session->set("bp", $bp);

        $data = [
            "message" => $message, //$session->get("message"),
            "names" => $session->get("bp")->getString(),
            "number" => $session->get("bp")->getNumberItems(),
        ];
        $next = "project/" . $session->get("last")  . ".html.twig";
        return $this->render($next, $data);
    }


    #[Route("/proj/endgame", name: "endgame")]
    public function endgame(
        SessionInterface $session
    ): Response {
        //$session->set("last", "endgame");

        $bp = $session->get("bp")->getString();
        if (in_array("key", $bp)) {

            $session->set("message", "You found the cake!");
            $data = [
                "message" => $session->get("message"),
                "names" => $bp,
            ];
            return $this->render('project/endgame.html.twig', $data);
        }

        $session->set("message", "You don't have a key!!!");
        $data = [
            "message" => $session->get("message"),
            "names" => $session->get("bp")->getString(),
        ];

        return $this->render('project/secret.html.twig', $data);
    }

    #[Route("/proj/cheat", name: "cheat")]
    public function cheat(
    ): Response {

        return $this->render('project/cheat.html.twig');
    }

    #[Route("/proj/about", name: "about")]
    public function about(
    ): Response {

        return $this->render('project/about.html.twig');
    }
}
