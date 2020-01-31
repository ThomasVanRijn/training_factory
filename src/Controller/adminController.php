<?php

namespace App\Controller;

use App\Entity\training;
use App\Entity\User;
use App\Form\Training1Type;
use App\Form\UserType;
use App\Repository\LessonRepository;
use App\Repository\RegistrationRepository;
use App\Repository\TrainingRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin", name="admin_")
 */
class adminController extends AbstractController
{
    // LEDEN

    /**
     * @Route("/leden/lijst", name="leden", methods={"GET"})
     */
    public function ledenLijst(UserRepository $userRepository): Response
    {
        return $this->render('views/admin/leden/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/leden/show/{id}", name="leden_show", methods={"GET"})
     */
    public function userShow(User $user, RegistrationRepository $registrationRepository): Response
    {
        return $this->render('views/admin/leden/show.html.twig', [
            'user' => $user,
            'registrations' => $registrationRepository->findAll(),
        ]);
    }

    //Disable
    /**
     * @Route("/user/{id}/disable", name = "user_disable", methods = {"DISABLE"})
     */
    public
    function userDisable(user $user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user->setDisabled(true);
        $entityManager->flush();
        return $this->redirectToRoute('admin_leden');
    }

    /**
     * @Route("/user/{id}/enable", name="user_enable", methods={"ENABLE"})
     */
    public function userEnable(user $user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user->setDisabled(false);
        $entityManager->flush();
        return $this->redirectToRoute('admin_leden');
    }


    // INSTRUCTEURS

    /**
     * @Route("/instructeur/lijst", name="instructeur_lijst", methods={"GET"})
     */
    public function instructeursLijst(UserRepository $userRepository): Response
    {
        return $this->render('views/admin/instructeur/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/instructeur/show/{id}", name="instructeur_show", methods={"GET"})
     */
    public function instructeursShow(User $user, LessonRepository $lessonRepository, RegistrationRepository $registrationRepository): Response
    {
        return $this->render('views/admin/instructeur/show.html.twig', [
            'user' => $user,
            'lessons' => $lessonRepository->findAll(),
            'registrations' => $registrationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/instructeur/delete/{id}", name="instructeur_delete", methods={"DELETE"})
     */
    public function instructeurDelete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_instructeur_lijst');
    }

    /**
     * @Route("/instructeur/new", name="instructeur_new", methods={"GET","POST"})
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
            $user->setRoles(['ROLE_INSTRUCTEUR']);
            $user->setDisabled(false);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('views/admin/instructeur/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    // DISABLE
    /**
     * @Route("/instructeur/{id}/disable", name="instructeur_disable", methods={"DISABLE"})
     */
    public function instructeurDisable(user $user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user->setDisabled(true);
        $entityManager->flush();
        return $this->redirectToRoute('admin_instructeur_lijst');
    }

    /**
     * @Route("/instructeur/{id}/enable", name="instructeur_enable", methods={"ENABLE"})
     */
    public function instructeurEnable(user $user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user->setDisabled(false);
        $entityManager->flush();
        return $this->redirectToRoute('admin_instructeur_lijst');
    }


    // USER CRUD

    /**
     * @Route("/gegevens-wijzigen", name="gegevens_wijzigen", methods={"GET"})
     */
    public function userIndex(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function userNew(Request $request, UserPasswordEncoderInterface $encoder): Response
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
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function userEdit(Request $request, User $user, UserPasswordEncoderInterface $encoder): Response
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
    public function userDelete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }


//    TRAINING CRUD

    /**
     * @Route("/training/overzicht", name="training_index", methods={"GET"})
     */
    public function trainingIndex(TrainingRepository $trainingRepository): Response
    {
        return $this->render('training/index.html.twig', [
            'trainings' => $trainingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/training/maken", name="training_new", methods={"GET","POST"})
     */
    public function trainingNew(Request $request): Response
    {
        $training = new training();
        $form = $this->createForm(Training1Type::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form['brochure']->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $training->setBrochureFilename($newFilename);
            }

            // ... persist the $product variable or any other work

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($training);
            $entityManager->flush();

            return $this->redirectToRoute('training_index');
        }

        return $this->render('training/new.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/training/overzicht/{id}", name="training_show", methods={"GET"})
     */
    public function trainingShow(training $training): Response
    {
        return $this->render('training/show.html.twig', [
            'training' => $training,
        ]);
    }

    /**
     * @Route("/training/overzicht/{id}/edit", name="training_edit", methods={"GET","POST"})
     */
    public function trainingEdit(Request $request, training $training): Response
    {
        $form = $this->createForm(Training1Type::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_training_index');
        }

        return $this->render('training/edit.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("training/delete/{id}", name="training_delete", methods={"DELETE"})
     */
    public function trainingDelete(Request $request, training $training): Response
    {
        if ($this->isCsrfTokenValid('delete' . $training->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($training);
            $entityManager->flush();
        }

        return $this->redirectToRoute('training_index');
    }
}