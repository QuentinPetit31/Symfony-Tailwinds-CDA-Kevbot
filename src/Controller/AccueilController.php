<?php 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController
{
    #[Route(path: '/addition/{num1}/{num2}', name: 'app_home_addition')]
    public function addition(int $num1, int $num2): Response
    {
        if ($num1 < 0 || $num2 < 0) {
            return new Response('<p>Les nombres sont négatifs</p>');
        }

        $resultat = $num1 + $num2;
        return new Response("<p>L’addition de $num1 et $num2 est égale au résultat : $resultat</p>");
    }
}
    ?>