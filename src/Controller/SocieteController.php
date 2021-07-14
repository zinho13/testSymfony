<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\SocieteRepository;
use App\Entity\Societe;
use App\Form\SocieteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SocieteController extends AbstractController
{
    /**
     * @Route("/societe", name="societe")
     */
    public function index(SocieteRepository $repoSociete): Response
    {
        return $this->render('societe/index.html.twig', [
            'controller_name' => 'SocieteController',
            'page_title' => 'Liste des sociétés',
            'societes' => $repoSociete->findAll()
        ]);
    }

    /**
     * @Route("/societe/ajout", name="add_societe")
     * @Route("/societe/edit/{id}", name="edit_societe")
     */
    public function formsSociete(SocieteRepository $repoSociete,
                                    Request $request,
                                    EntityManagerInterface $manager,
                                    Societe $societes = null): Response
    {
        $isEdit = true;

        if (!$societes) {
            $societes = new Societe();
            $isEdit = false;
        }

        $formSociete = $this->createForm(SocieteType::class, $societes);
        $formSociete->handleRequest($request);

        if ($formSociete->isSubmitted() && $formSociete->isValid()) {
            if (!$societes->getId()) {
                $societes->setCreatedAt(new \Datetime);
            }
            $societes->setUpdatedAt(new \DateTime());

            $manager->persist($societes);
            $manager->flush();

            return $this->redirectToRoute('societe');
        }

        return $this->render('societe/add.html.twig', [
            'controller_name' => 'SocieteController',
            'page_title' => 'création société',
            'isEdit' => $isEdit,
            'formSociete' => $formSociete->createView()
        ]);
    }

    /**
     * @Route("/societe/delete/{id}", name="delete_societe")
     */
    public function deleteSociete(Request $request, EntityManagerInterface $manager,
                                    Societe $societe): Response
    {
        $manager->remove($societe);
        $manager->flush();
        $this->addFlash('danger', 'élement a été supprimé');
        
        return $this->redirectToRoute('societe');
    }
}
