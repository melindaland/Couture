<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticPages extends AbstractController
{
    // route pour la page d'accueil
    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        return $this->render('accueil.html.twig', [
            'titre' => 'Accueil'
        ]);
    }

	// route pour voir tous les cours
    #[Route('/cours', name: 'cours')]
    public function cours(): Response
    {
        return $this->render('cours.html.twig', [
            'titre' => 'Cours'
        ]);
    }

	// route pour voir tous les tutoriels
    #[Route('/tutoriels', name: 'tutoriels')]
    public function tutoriels(): Response
    {
        return $this->render('tutoriels.html.twig', [
            'titre' => 'Tutoriels'
        ]);
    }
}
