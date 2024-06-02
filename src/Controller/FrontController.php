<?php

namespace App\Controller;

use App\Entity\Coach;
use App\Entity\Player;
use App\Entity\Team;
use App\Repository\CoachRepository;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;
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

    #[Route('/cookies', name: 'app_cookies')]
    public function cookies(){
        return $this->render('front/cookies.html.twig', [
        ]);
    }

    #[Route('/FAQ', name: 'app_faq')]
    public function faq(){
        return $this->render('front/faq.html.twig', [
        ]);
    }

    #[Route('/preview/player/{id}', name: 'app_preview_player',methods: ['GET'])]
    public function previewPlayer(Player $player){
        return $this->render('preview.html.twig', [
            'object' => $player
        ]);
    }

    #[Route('/preview/coach/{id}', name: 'app_preview_coach',methods: ['GET'])]
    public function previewCoach(Coach $coach){
        return $this->render('preview.html.twig', [
            'object'=>$coach
        ]);
    }

    #[Route('/preview/team/{id}', name: 'app_preview_team',methods: ['GET'])]
    public function previewTeam(Team $team){
        return $this->render('preview.html.twig', [
            'object'=>$team
        ]);
    }

    #[Route('/about', name: 'app_aboutUs')]
    public function aboutUs(){
        return $this->render('front/aboutUs.html.twig', [
        ]);
    }

    #[Route('/contact', name: 'app_contact',methods: ['GET','POST'])]
    public function contact(){


        return $this->render('front/contact.html.twig', [
        ]);
    }
}
