<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class BackofficeController extends AbstractController
{
    #[Route('/admin', name: 'app_backoffice')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_player_index');
    }
}
