<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\TypeSocieteRepository;
use App\Entity\TypeSociete;
use App\Form\TypeSocieteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TypeSocieteController extends AbstractController
{
    /**
     * @Route("/type-societe", name="type_societe")
     */
    public function index(TypeSocieteRepository $repoTypeSociete): Response
    {
        return $this->render('type_societe/index.html.twig', [
            'controller_name' => 'TypeSocieteController',
            'page_title' => 'Liste des types sociétés',
            'typeSocietes' => $repoTypeSociete->findAll()
        ]);
    }

    /**
     * @Route("/type-societe/ajout", name="add_type_societe")
     * @Route("/type-societe/edit/{id}", name="edit_type_societe")
     */
    public function formsTypeSociete(TypeSocieteRepository $repoTypeSociete,
                                    Request $request,
                                    EntityManagerInterface $manager,
                                    TypeSociete $typeSocietes = null): Response
    {
        $isEdit = true;

        if (!$typeSocietes) {
            $typeSocietes = new TypeSociete();
            $isEdit = false;
        }

        $formTypeSociete = $this->createForm(TypeSocieteType::class, $typeSocietes);
        $formTypeSociete->handleRequest($request);

        if ($formTypeSociete->isSubmitted() && $formTypeSociete->isValid()) {
            if (!$typeSocietes->getId()) {
                $typeSocietes->setCreatedAt(new \Datetime());
            }
            $typeSocietes->setUpdatedAt(new \Datetime());

            $manager->persist($typeSocietes);
            $manager->flush();

            return $this->redirectToRoute('type_societe');
        }

        return $this->render('type_societe/add.html.twig', [
            'controller_name' => 'TypeSocieteController',
            'page_title' => 'création code postal',
            'isEdit' => $isEdit,
            'formTypeSociete' => $formTypeSociete->createView()
        ]);
    }

    /**
     * @Route("type-societe/delete/{id}", name="delete_type_societe")
     */
    public function deleteTypeSociete(Request $request,
                                        EntityManagerInterface $manager,
                                        TypeSociete $typeSociete): Response
    {
        $manager->remove($typeSociete);
        $manager->flush();
        $this->addFlash('danger', 'élement a été supprimé');
        
        return $this->redirectToRoute('type_societe');
    }
}
