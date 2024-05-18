<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 *
 */
class LuckyController
{
    /**
     * @return Response
     */
    #[Route('/lucky/number')]
    public function number(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html lang="en"><body>lucky number: '.$number.'</body></html>'
        );
    }
}