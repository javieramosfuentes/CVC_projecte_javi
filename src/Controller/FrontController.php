<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, PlayerRepository $playerRepository): Response
    {
        $query = $request->query->get('query', '');
        if ($query === '') {
            $players = $playerRepository->createQueryBuilder('p')
                ->orderBy('p.name', 'ASC')
                ->setMaxResults(15)
                ->getQuery()
                ->getResult();
        } else {
            $players = $playerRepository->createQueryBuilder('p')
                ->where('p.name LIKE :query')
                ->setParameter('query', '%' . $query . '%')
                ->orderBy('p.name', 'ASC')
                ->setMaxResults(15)
                ->getQuery()
                ->getResult();
        }

        return $this->render('front/index.html.twig', [
            'players' => $players,
        ]);
    }
}
