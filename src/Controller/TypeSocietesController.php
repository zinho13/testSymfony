<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeSocietesController extends AbstractController
{
    /**
     * @Route("/type/societes", name="type_societes")
     */
    public function index(): Response
    {
        return $this->render('type_societes/index.html.twig', [
            'controller_name' => 'TypeSocietesController',
        ]);
    }
}
