<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Registration;
use App\Entity\User;
use App\Form\LessonType;
use App\Form\UserType;
use App\Repository\LessonRepository;
use App\Repository\RegistrationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/instructeur")
 */
class InstructeurController extends AbstractController
{
    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function editInstructor(Request $request, User $user, UserPasswordEncoderInterface $encoder): Response
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


    //LESSON CRUD

    /**
     * @Route("/lesson/plannen", name="lesson_plannen", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lesson = new Lesson();
        $user = $this->getUser();
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lesson->setInstructeur($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lesson);
            $entityManager->flush();

            return $this->redirectToRoute('lesson_overzicht');
        }

        return $this->render('views/instructeur/new.html.twig', [
            'lesson' => $lesson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/lesson/overzicht", name="lesson_overzicht", methods={"GET"})
     */
    public function index(LessonRepository $lessonRepository): Response
    {
        return $this->render('views/instructeur/index.html.twig', [
            'lessons' => $lessonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/overzicht/{id}", name="lesson_show", methods={"GET"})
     */
    public function show(Lesson $lesson, RegistrationRepository $registrationRepository): Response
    {
        return $this->render('views/instructeur/show.html.twig', [
            'lesson' => $lesson,
            'registrations' => $registrationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/lesson/betaal/{id}", name="user_betalen", methods={"BETAAL"})
     */
    public function betaalt(Request $request, Registration $registration): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $registration->setPayment(true);
        $entityManager->flush();

        return $this->redirectToRoute('lesson_show', ['id' => $registration->getLesson()->getId()]);
    }

    /**
     * @Route("/overzicht/{id}/edit", name="lesson_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lesson $lesson): Response
    {
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lesson_overzicht');
        }

        return $this->render('views/instructeur/edit.html.twig', [
            'lesson' => $lesson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lesson_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Lesson $lesson): Response
    {
        if ($this->isCsrfTokenValid('delete' . $lesson->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lesson);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lesson_overzicht');
    }
}
