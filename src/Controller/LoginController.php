<?php

namespace App\Controller;

use App\Entity\Login;
use App\Entity\Player;
use App\Entity\User;
use App\Form\LoginType;
use App\Form\PlayerType;
use App\Form\RegisterType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, AuthorizationCheckerInterface $authorizationChecker): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        if ($authorizationChecker->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_backoffice');
        }elseif ($authorizationChecker->isGranted('ROLE_USER')){
            return $this->redirectToRoute('app_home');
        }

        return $this->render('login/index.html.twig', [
            'last_username'=> $lastUsername,
            'error'        => $error
        ]);
    }

    #[Route('/register', name: 'app_register',methods: ['GET', 'POST'])]
    public function register(Request $request, EntityManagerInterface $entityManager):Response{
        $login = new Login();
        $form = $this->createForm(RegisterType::class, $login);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentDate = new DateTime();

            // Create and set the user entity
            $user = new User();
            $user->setEmail($form->get('user')->get('email')->getData());
            $entityManager->persist($user);

            $login->setRole("ROLE_USER");
            $login->setLastLogin($currentDate);
            $passwd = $login->getPassword();
            $login->setPassword($this->hasher->hashPassword($login, $passwd));
            $login->setUser($user);

            $entityManager->persist($login);
            $entityManager->flush();



            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('login/register.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {

    }
}
