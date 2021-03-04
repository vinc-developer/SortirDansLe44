<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\InscriptionUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PersonneController extends AbstractController
{
    private $entityManager;
    private $encoder;

    /**
     * PersonneController constructor.
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }


    /**
     * @Route("/admin/inscription-user", name="register")
     */
    public function inscriptionUser(Request $request,UserPasswordEncoderInterface $encoder): Response
    {
        //instanciation de la classe Personne
        $personne = new Personne();
        $form = $this->createForm(InscriptionUserType::class, $personne);

        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $personne = $form->getData();


            $password = $encoder->encodePassword($personne,$personne->getPassword());

            $personne = $personne->setPassword($password);



            $this->entityManager->persist($personne);
            $this->entityManager->flush($personne);
        }

        return $this->render('register/incription-user.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
