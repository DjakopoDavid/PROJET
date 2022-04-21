<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/security', name: 'security')]

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="app_security")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SecurityController.php',
        ]);
    }

   #[Route('/addusers', name: 'addusers')]

   public function addUsersAction(ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
   {

       $em = $doctrine->getManager();
       $user = new User();
       $user->setLogin('sadmin')
           ->setNom('Matthieu')
           ->setPrenom('Jean')
           ->setRoles(['ROLE_SUPER_ADMINISTRATEUR']);
       $hashedPassword = $passwordHasher->hashPassword($user, 'nimdas');
       $user->setPassword($hashedPassword)
            ->setDateNaissance('2000-02-14');
       $em->persist($user);
       $em->flush();
       dump($user);
       return $this->redirectToRoute('register', ['id' => $user->getId()]);

   }

}
