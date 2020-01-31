<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route ("/bezoeker", name="")
 */
class bezoekersController extends AbstractController
{
    /**
     * @Route ("/trainings-aanbod", name="trainings_aanbod")
     */
    public function trainingsAanbod(TrainingRepository $trainingRepository): Response
    {
        return $this->render('views/bezoeker/trainings-aanbod.html.twig', [
            'trainings' => $trainingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/lid-worden", name="lid_worden", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new user();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $user->setDisabled(false);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
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