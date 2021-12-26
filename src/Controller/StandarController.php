<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StandarController extends AbstractController
{
    /**
     * @Route("/standar", name="standar")
     */
    public function index(): Response
    {
        return $this->render('standar/index.html.twig', [
            'controller_name' => 'Juan David',
        ]);
    }
}
