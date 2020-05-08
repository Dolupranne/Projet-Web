<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Achat;
use App\Entity\HistoriqueEnchere;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/jeton", name="user_jeton", methods={"GET"})
     */
    public function nbJetons(): Response
    {
        $nbJetons = $this->getNbJetons();

        return $this ->render('user/jeton.html.twig', [
            'nbJetons' => $nbJetons,
        ]);
    }

    public function getNbJetons(): int
    {
        $entityManager = $this->getDoctrine()->getManager();
        $nbJetons = $entityManager->getRepository(Achat::class)
        ->createQueryBuilder('achat')
        ->where('achat.user = :user')
        ->setParameter('user', $this->getUser())
        ->join('achat.packJetons', 'packJetons')
        ->select('SUM(packJetons.nbjetons)')
        ->getQuery()->getSingleScalarResult();
        $nbJetons -= $entityManager->getRepository(HistoriqueEnchere::class)
        ->createQueryBuilder('he')
        ->where('he.user = :user')
        ->setParameter('user', $this->getUser())
        ->select('COUNT(he)')
        ->getQuery()->getSingleScalarResult();

        return $nbJetons;
    }





    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'title'=>'Vos jetons'
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index', [
                'title'=>'Vos jetons'
            ]);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'title'=>'Vos jetons'
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
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
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
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
