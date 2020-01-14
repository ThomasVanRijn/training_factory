<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Registration;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user", name="")
 */
class LedenController extends AbstractController
{
    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $encoder): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
//    /**
//     * @Route("/inschrijven/{id}" , name="app_nu_inschrijvingen")
//     */
//
//    public function inschrijvenLesson($id)
//    {
//        $les = $this->getDoctrine()
//            ->getRepository(Lesson::class)
//            ->find($id);
//
//        $user=$this->getUser();
//
//        $reg=new Registration();
//        $reg->setlesson($les);
//        $reg->setUser($user);
//        $reg->setPayment(true);
//        $entityManager = $this->getDoctrine()->getManager();
//        $entityManager->persist($reg);
//        $entityManager->flush();
//
//        return $this->render('views/bezoeker/home.html.twig');
//    }
}