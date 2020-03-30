<?php

namespace App\Controller;

use App\Entity\PackJeton;
use App\Form\PackJetonType;
use App\Repository\PackJetonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pack/jeton")
 */
class PackJetonController extends AbstractController
{
    /**
     * @Route("/", name="pack_jeton_index", methods={"GET"})
     */
    public function index(PackJetonRepository $packJetonRepository): Response
    {
        return $this->render('pack_jeton/index.html.twig', [
            'pack_jetons' => $packJetonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pack_jeton_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $packJeton = new PackJeton();
        $form = $this->createForm(PackJetonType::class, $packJeton);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($packJeton);
            $entityManager->flush();

            return $this->redirectToRoute('pack_jeton_index');
        }

        return $this->render('pack_jeton/new.html.twig', [
            'pack_jeton' => $packJeton,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pack_jeton_show", methods={"GET"})
     */
    public function show(PackJeton $packJeton): Response
    {
        return $this->render('pack_jeton/show.html.twig', [
            'pack_jeton' => $packJeton,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pack_jeton_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PackJeton $packJeton): Response
    {
        $form = $this->createForm(PackJetonType::class, $packJeton);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pack_jeton_index');
        }

        return $this->render('pack_jeton/edit.html.twig', [
            'pack_jeton' => $packJeton,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pack_jeton_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PackJeton $packJeton): Response
    {
        if ($this->isCsrfTokenValid('delete'.$packJeton->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($packJeton);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pack_jeton_index');
    }
}
