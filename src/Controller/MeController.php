<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MeController
{
    /*     #[Route('/')]
        public function hi(): Response
        {
            return new Response(
                '<html><body>I am Ingrid </body></html>'
            );
        }

        #[Route('/about')]
        public function About(): Response
        {

            return new Response(
                '<html><body>This is the mvc course</body></html>'
            );
        } */

    //    #[Route('/report')]
    //    public function Report(): Response
    //    {
    //
    //
    //        return new Response(
    //            '<html><body>This is the report page</body></html>'
    //        );
    //    }

    /*     #[Route('/lucky')]
        public function number(): Response
        {
            $number = random_int(0, 100);

            return new Response(
                '<html><body>Lucky number: '.$number.'</body></html>'
            );
        }

        #[Route("/api")]
        public function jsonNumber(): Response
        {
            $number = random_int(0, 100);

            $data = [
                '/' => 'page about me',
                'about' => 'about this course',
                'report' => 'my reports',
                'lucky' => 'get your lucky number',
                'api' => 'this page over routes'

            ];

            //return new JsonResponse($data);
            $response = new JsonResponse($data);
            $response->setEncodingOptions(
                $response->getEncodingOptions() | JSON_PRETTY_PRINT
            );
            return $response;
        }

        #[Route("/api/quote")]
        public function quote(): Response
        {
            $number = random_int(0, 2);

            $data = ['You shall not pass', 'may the odds be ever in your favour','bowties are cool'

            ];

            return new Response(
                '<html><body>Quote of the day: '.$data[$number].'</body></html>'
            );
        } */

}
