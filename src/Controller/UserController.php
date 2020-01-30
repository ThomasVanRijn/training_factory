<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Registration;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\LessonRepository;
use App\Repository\RegistrationRepository;
use App\Repository\TrainingRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/lesson/overzicht", name="user_lessen_overzicht")
     */
    public function lessenOverzicht(LessonRepository $LessonRepository, TrainingRepository $trainingRepository, RegistrationRepository $registrationRepository)
    {
        return $this->render('views/leden/inschrijven.html.twig', [
            'lessons' => $LessonRepository->findAll(),
            'trainings' => $trainingRepository->findAll(),
            'registrations' => $registrationRepository->findBy([
                'user' => $this->getUser(),
            ])
        ]);
    }

    /**
     * @Route("/inschrijven/{id}" , name="app_nu_inschrijvingen")
     */
    public function inschrijvenLesson($id, EntityManagerInterface $em)
    {
        $les = $this->getDoctrine()->getRepository(Lesson::class)->find($id);
        $user = $this->getUser();

        $reg = new Registration();
        $reg->setLesson($les);
        $reg->setUser($user);
        $reg->setpayment(false);

        $em->persist($reg);
        $em->flush();
        return $this->redirectToRoute('user_lessen_overzicht');
    }

    /**
     * @Route("/inschrijvingen/overzicht" , name="inschrijvingen_overzicht")
     */
    public function inschrijvingenOverzicht(RegistrationRepository $registrationRepository): Response
    {
        return $this->render('views/leden/overzicht-inschrijvingen.html.twig', [
            'registrations' => $registrationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/inschrijving/verwijderen{id}", name="app_uitschrijven", methods={"DELETE"})
     */
    public function uitschrijven(Request $request, Registration $Registration): Response
    {
        if ($this->isCsrfTokenValid('delete' . $Registration->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Registration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_lessen_overzicht');
    }

    /**
     * @Route("/gegevens-wijzigen", name="gegevens_wijzigen", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
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
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

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

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
