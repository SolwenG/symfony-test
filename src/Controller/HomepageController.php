<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(ProduitRepository $produitRepository): Response
    {
        $user = $this->getUser();
        dump($user);

        $produits = $produitRepository->findAll();

        return $this->render('base.html.twig', [
            'controller_name' => 'HomepageController',
            'produits' => $produits,
        ]);
    }
}
