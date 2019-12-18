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
        return $this->render('/views/bezoeker/home.html.twig');
    }

    /**
     * @Route ("/trainings-aanbod", name="trainings-aanbod")
     */
    public function trainingsAanbod(TrainingRepository $trainingRepository): Response
    {
        return $this->render('views/bezoeker/trainings-aanbod.html.twig', [
            'trainings' => $trainingRepository->findAll(),
        ]);
    }
    /**
     * @Route ("/lid-worden", name="lid-worden")
     */
    public function lidWorden()
    {
        return $this->render('/views/bezoeker/lid-worden.html.twig');
    }

    /**
     * @Route ("/gedrachtsregels", name="gedrachtsregels")
     */
    public function gedrachtsregels()
    {
        return $this->render('views/bezoeker/gedrachtsregels.html.twig');
    }
    /**
     * @Route ("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('views/bezoeker/contact.html.twig');
    }
}