<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/encherir")
 */
class EncherirController extends AbstractController
{
    /**
     * @Route("/", name="encherir_index", methods={"GET"})
     */
    public function index()
    {
        return $this->render('encherir/index.html.twig', [
            'controller_name' => 'EncherirController',
        ]);
    }
}
