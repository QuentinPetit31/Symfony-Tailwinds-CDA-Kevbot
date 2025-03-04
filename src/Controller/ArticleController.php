<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleController extends AbstractController
{
    #[Route('/addArticle', name: 'app_addArticle')]
    public function addArticle(Request $request): Response
    {
        // Création du formulaire
        $form = $this->createFormBuilder()
            ->add('title', TextType::class, [
                'label' => "Titre de l'article",
                'attr' => ['class' => 'w-full px-4 py-2 rounded-lg text-black']
            ])
            ->add('content', TextareaType::class, [
                'label' => "Contenu de l'article",
                'attr' => ['class' => 'w-full px-4 py-2 rounded-lg text-black', 'rows' => 5]
            ])
            ->add('author', TextType::class, [
                'label' => "Auteur",
                'attr' => ['class' => 'w-full px-4 py-2 rounded-lg text-black']
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Publier',
                'attr' => ['class' => 'mt-4 px-6 py-3 bg-cyan-500 text-black rounded-lg hover:bg-cyan-600 transition']
            ])
            ->getForm();

        // Vérifier si le formulaire est bien généré
        dump($form->createView());

        return $this->render('addArticle.html.twig', [
            'form' => $form->createView(),
            'title' => "Créer un nouvel article",
            'content' => "Remplissez le formulaire ci-dessous pour ajouter un nouvel article à la base de données.",
            'author' => "Dr. Quentin",
            'date' => date('d/m/Y')
        ]);
    }
}
