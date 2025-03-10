<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AccountRepository;

final class UserController extends AbstractController
{
    public function __construct(
        private readonly AccountRepository $accountRepository
    ) {}

    #[Route('/register', name: 'app_user_register')]
    public function register(): Response
    {
        return $this->render('user/register.html.twig');
    }

    #[Route('/login', name: 'app_user_login')]
    public function login(): Response
    {
        return $this->render('user/login.html.twig');
    }

    #[Route('/account', name: 'app_user_accounts')]
    public function showAllAccounts(): Response
    {
        return $this->render('accounts.html.twig', [
            "accounts" => $this->accountRepository->findAll()
        ]);
    }
}