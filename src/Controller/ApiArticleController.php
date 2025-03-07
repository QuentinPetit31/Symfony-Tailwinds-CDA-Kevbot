<?php

namespace App\Controller;

use App\Repository\AccountRepository;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use Symfony\Component\Routing\Attribute\Route;

class ApiArticleController extends AbstractController
{
    public function __construct(
        private ArticleRepository $accountRepository
    ) {}

    #[Route('/api/article', name: 'apiArticle', methods: ['GET'])]
    public function getAllAccounts(): Response
    {
        return $this->json(
            $this->accountRepository->findAll(),
            200,
            [],
            ['groups' => 'account:read']
        );
    }

    #[Route('/api/account/update', name: 'api_update_account', methods: ['PUT'])]
public function updateAccount(
    Request $request,
    EntityManagerInterface $entityManager,
    AccountRepository $accountRepository,
    SerializerInterface $serializer
): JsonResponse {
    // Récupére le JSON envoyé dans la requête
    $data = json_decode($request->getContent(), true);

    if (!isset($data['email']) || !isset($data['firstname']) || !isset($data['lastname'])) {
        return new JsonResponse(['error' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
    }

    $account = $accountRepository->findOneBy(['email' => $data['email']]);

    if (!$account) {
        return new JsonResponse(['error' => 'Account not found'], Response::HTTP_NOT_FOUND);
    }

    // Mets à jour les infos
    $account->setFirstname($data['firstname']);
    $account->setLastname($data['lastname']);

    // Sauvegarde
    $entityManager->persist($account);
    $entityManager->flush();

    // Retourne la réponse JSON
    $jsonAccount = $serializer->serialize($account, 'json', ['groups' => 'account:read']);
    return new JsonResponse($jsonAccount, Response::HTTP_OK, [], true);
}

}
