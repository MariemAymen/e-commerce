<?php

namespace App\Controller;

use App\Form\EspacePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EspacePasswordController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em){

        $this->em = $em;
    }
    #[Route('/espace/password_modify', name: 'password_modify')]
    public function index(Request $request,UserPasswordHasherInterface $hasher): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EspacePasswordType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //comparaison du mot de passe actuel a celui saisi dans le formulaire
            $old_pwd = $form->get('old_password')->getData();
            if ($hasher->isPasswordValid($user, $old_pwd)) {
                //modification de mot de passe 
                $new_pwd = $form->get('new_password')->getData();
                $user->setPassword($hasher->hashPassword($user, $new_pwd));
                $this->em->persist($user);
                $this->em->flush();
                // return $this->redirectToRoute('homepage');
                $this->addFlash('success', 'Votre mot de passe a bien été modifié');

            }else{
                $this->addFlash('error', 'Votre mot de passe actuel est incorrect');
            }
        }

        return $this->render('espace/change_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
