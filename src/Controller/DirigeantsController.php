<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DirigeantsController extends AbstractController
{
    /**
     * @Route("/dirigeants", name="dirigeants")
     */
    public function index(): Response
    {
        return $this->render('dirigeants/index.html.twig', [
            'controller_name' => 'DirigeantsController',
        ]);
    }
}
