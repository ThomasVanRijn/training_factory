<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class bezoekersController extends AbstractController
{
    /**
     * @Route ("/", name="app_homepage")
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
        return $this->render('/views/bezoeker/home.html.twig', [
            ]
        );
    }
}