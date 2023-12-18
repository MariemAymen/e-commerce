<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'about')]
    public function index(): Response
    {
   
        $donnees = [
'poste' => 'Developpement web!',
'description' => 'Vous pouvez vous inscrire à notre newsletter pour recevoir des news notre site!',
];
         return $this->render('about/index.html.twig', [
           
            'donnees' => $donnees,
         ]);
}}
