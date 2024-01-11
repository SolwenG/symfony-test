<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\AjoutProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    #[Route('/produits', name: 'app_produits')]

    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $produit = new Produit();
        $form = $this->createForm(AjoutProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();
            return $this->redirectToRoute('app_homepage', []);
        }

        return $this->render('produits/index.html.twig', [
            'formProduit' => $form->createView(),
        ]);
    }
}
