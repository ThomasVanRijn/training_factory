<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ledenController extends AbstractController
{

    /**
     * @Route ("/home", name="homepage")
     */
    public function homePage()
    {
        return $this->render('/views/member/home.html.twig', [
            ]
        );
    }

    /**
     * @Route ("/inschrijven", name="inschrijven")
     */
    public function inschrijven()
    {
        return $this->render('/views/member/inschrijven.html.twig', [
            ]
        );
    }

    /**
     * @Route ("/overzicht_inschrijvingen", name="overzicht_inschrijvingen")
     */
    public function overzicht_inschrijvingen()
    {
        return $this->render('/views/member/overzicht-inschrijvingen.html.twig', [
            ]
        );
    }
}