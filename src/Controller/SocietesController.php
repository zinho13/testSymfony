<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SocietesController extends AbstractController
{
    /**
     * @Route("/societes", name="societes")
     */
    public function index(): Response
    {
        return $this->render('societes/index.html.twig', [
            'controller_name' => 'SocietesController',
        ]);
    }
}
