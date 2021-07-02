<?php

namespace App\Controller;

use App\Entity\CodePostals;
use App\Form\AddCodePostalType;
use App\Repository\CodePostalsRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CodePostalsController extends AbstractController
{
    /**
     * @Route("/code/postals", name="code_postals")
     */
    public function index(): Response
    {
        return $this->render('code_postals/index.html.twig', [
            'controller_name' => 'CodePostalsController',
        ]);
    }

    /**
     * @Route("/code/postals", name="code_postals")
     */
    public function addCodePostal(Request $request, EntityManagerInterface $manager, CodePostals $codePostal, CodePostalsRepository $reposCodePostal): Response
    {
        $codePost = new CodePostals();
        $formCodePostal = $this->createForm(AddCodePostalType::class, $codePost);
        $formCodePostal->handleRequest($request);
        
        if ($formCodePostal->isSubmitted() && $formCodePostal->isValid()) { 
            $manager->persist($codePost);
            $manager->flush();
        }

        return $this->render('code_postals/index.html.twig',
        [
            // 'codepost' => $codePost,
            'formCodePostal' => $formCodePostal->createView()
        ]);
    }
}
