<?php

namespace App\Controller;

use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class bezoekersController extends AbstractController
{
    /**
     * @Route ("/", name="home")
     */
    public function home()
    {
        return $this->render('/views/bezoeker/home.html.twig', [
            ]
        );
    }

    /**
     * @Route ("/lid_worden", name="lid_worden")
     */
    public function lid_worden()
    {
        return $this->render('/views/bezoeker/lidWorden.html.twig', [
            ]
        );
    }

    /**
     * @Route ("/trainingsAanbod", name="trainingsAanbod")
     */
    public function trainingsAanbod(TrainingRepository $trainingRepository): Response
    {
        return $this->render('views/bezoeker/trainingsAanbod.html.twig', [
            'trainings' => $trainingRepository->findAll(),
        ]);
    }
}