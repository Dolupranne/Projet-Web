<?php

namespace App\Controller;

use App\Entity\HistoriqueEnchere;
use App\Form\HistoriqueEnchereType;
use App\Repository\HistoriqueEnchereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/historique/enchere")
 */
class HistoriqueEnchereController extends AbstractController
{
    /**
     * @Route("/", name="historique_enchere_index", methods={"GET"})
     */
    public function index(HistoriqueEnchereRepository $historiqueEnchereRepository): Response
    {
        return $this->render('historique_enchere/index.html.twig', [
            'historique_encheres' => $historiqueEnchereRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="historique_enchere_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $historiqueEnchere = new HistoriqueEnchere();
        $form = $this->createForm(HistoriqueEnchereType::class, $historiqueEnchere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($historiqueEnchere);
            $entityManager->flush();

            return $this->redirectToRoute('historique_enchere_index');
        }

        return $this->render('historique_enchere/new.html.twig', [
            'historique_enchere' => $historiqueEnchere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="historique_enchere_show", methods={"GET"})
     */
    public function show(HistoriqueEnchere $historiqueEnchere): Response
    {
        return $this->render('historique_enchere/show.html.twig', [
            'historique_enchere' => $historiqueEnchere,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="historique_enchere_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HistoriqueEnchere $historiqueEnchere): Response
    {
        $form = $this->createForm(HistoriqueEnchereType::class, $historiqueEnchere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('historique_enchere_index');
        }

        return $this->render('historique_enchere/edit.html.twig', [
            'historique_enchere' => $historiqueEnchere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="historique_enchere_delete", methods={"DELETE"})
     */
    public function delete(Request $request, HistoriqueEnchere $historiqueEnchere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$historiqueEnchere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($historiqueEnchere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('historique_enchere_index');
    }
}
