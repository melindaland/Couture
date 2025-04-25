<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\SousCategorie; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CategorieController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    //route pour afficher la liste des catégories
    #[Route('/category', name: 'category_list')]
    public function list()
    {
        // récupérer toutes les catégories
        $categories = $this->entityManager->getRepository(Categorie::class)->findAll();

        return $this->render('categorie.html.twig', [
            'categories' => $categories,
        ]);
    }

    // route pour afficher les sous-catégories d'une catégorie spécifique
    #[Route('/category/{id}', name: 'subcategory_list')]
    public function showSubcategories($id)
    {
        $categorie = $this->entityManager->getRepository(Categorie::class)->find($id);

        // si la catégorie n'existe pas, renvoyer une page d'erreur
        if (!$categorie) {
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        $sousCategories = $categorie->getSousCategories();

        return $this->render('souscategorie.html.twig', [
            'categorie' => $categorie,
            'sousCategories' => $sousCategories,
        ]);
    }

    // route pour afficher les objets d'une sous-catégorie
    #[Route('/subcategory/{id}', name: 'show_subcategory_objects')]
    public function showSubcategoryObjects($id)
    {
        $sousCategorie = $this->entityManager->getRepository(SousCategorie::class)->find($id);

        if (!$sousCategorie) {
            throw $this->createNotFoundException('Sous-catégorie non trouvée');
        }

        $objets = $sousCategorie->getObjets(); 

        return $this->render('objet.html.twig', [
            'sousCategorie' => $sousCategorie,
            'objets' => $objets,
        ]);
    }
}
