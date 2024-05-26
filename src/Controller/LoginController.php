<?php

namespace App\Controller;

use App\Entity\Login;
use App\Entity\User;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, AuthorizationCheckerInterface $authorizationChecker): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        if ($authorizationChecker->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_home');
        }elseif ($authorizationChecker->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('app_backoffice');
        }

        return $this->render('login/index.html.twig', [
            'last_username'=> $lastUsername,
            'error'        => $error
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {

    }
}
