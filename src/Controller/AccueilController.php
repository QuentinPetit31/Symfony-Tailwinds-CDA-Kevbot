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


    #[Route(path:'/calculatrice/{nbr1}/{nbr2}/{operateur}', name: 'app_accueil_calculatrice')]
    public function calculatrice(mixed $nbr1, mixed $nbr2, string $operateur) : Response {
        //Test si nbr1 ou nbr2 sont des nombres
        if(!is_numeric($nbr1) || !is_numeric($nbr2)) {
            $response = "<p>Les deux nombres ne sont pas numériques</p>";
        }
        //Sinon 
        else {
            switch ($operateur) {
                case 'add':
                    $response = "<p>L'addition de $nbr1 et $nbr2 est égale au résultat : " . ($nbr1 + $nbr2) . '</p>';
                    break;
                case 'sous':
                    $response = "<p>La soustraction de $nbr1 et $nbr2 est égale au résultat : " . ($nbr1 - $nbr2) . '</p>';
                    break;
                case 'multi':
                $response = "<p>La multiplication de $nbr1 et $nbr2 est égale au résultat : " . ($nbr1 * $nbr2) . '</p>';
                    break;
                case 'div':
                    if($nbr2 === 0) {
                        $response = "<p>Division par zéro impossible</p>";
                    }else{
                        $response = "<p>La division de $nbr1 et $nbr2 est égale au résultat : " . ($nbr1 / $nbr2) . '</p>';
                    }
                    break;
                default:
                    $response = "<p>Opérateur inconnu</p>";
                    break;
            }
        }
        return new Response($response);
    }
    
}
    ?>