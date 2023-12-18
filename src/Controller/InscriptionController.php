<?php

namespace App\Controller;

use App\Entity\User;//declaration de l'espace de nom
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class InscriptionController extends AbstractController
{
    private EntityManagerInterface $em;//declaration de la proprite em de type EntityManagerInterface
    public function __construct(EntityManagerInterface $em){// injection de dependance de l'EntityManager

        $this->em = $em;//Initilisation de l'EntityManager( de la proprete $em)
    }

    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request): Response
    {
        
        $user= new User();// creation d'un nouvelle utilisateur
        $form = $this->createForm(InscriptionType::class,$user);//creation de formulaire d'inscription
        $form -> handLeRequest($request);//Gestion de la requete
        if($form->isSubmitted()&&$form->isValid()){
            $user = $form->getData();
            //on verifier l'existance de l'adresse email de l'utilisateur
            $userExist = $this->em->getRepository(User::class)->findOneBy(['email'=>$user->getEmail()]);
if(!$userExist){
    //hashage du mot de passe
    $user->setPassword(password_hash($user->getPassword(),PASSWORD_ARGON2I));
  
    //enregistrement de l'utilisateur à la base de données
    $this->em->persist($user);//permet de preparer une requete SQL
    $this->em->flush();//executer la requete SQL
    $this->addFlash('success','Votre inscription a bien été effectuée');
    return $this->redirectToRoute('app_login');
}else{
$this->addFlash('error','Cette adresse email est déja utilisée');
}
        }
        return $this->render('inscription/index.html.twig', [
           'form' => $form->createView(),//creation du la vue
        ]);
    }
}
