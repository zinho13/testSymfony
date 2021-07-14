<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\DirigeantRepository;
use App\Entity\Dirigeant;
use App\Form\DirigeantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DirigeantController extends AbstractController
{
    /**
     * @Route("/dirigeant", name="dirigeant")
     */
    public function index(DirigeantRepository $repoDirigeant): Response
    {
        return $this->render('dirigeant/index.html.twig', [
            'controller_name' => 'DirigeantController',
            'page_title' => 'Liste des dirigeants',
            'dirigeants' => $repoDirigeant->findAll()
        ]);
    }

    /**
     * @Route("/dirigeant/ajout", name="add_dirigeant")
     * @Route("/dirigeant/edit/{id}", name="edit_dirigeant")
     */
    public function formsDirigeant(DirigeantRepository $repoDirigeant,
                                    Request $request,
                                    EntityManagerInterface $manager,
                                    Dirigeant $dirigeants = null): Response
    {
        $isEdit = true;

        if (!$dirigeants) {
            $dirigeants = new Dirigeant();
            $isEdit = false;
        }

        $formDirigeant = $this->createForm(DirigeantType::class, $dirigeants);
        $formDirigeant->handleRequest($request);

        if ($formDirigeant->isSubmitted() && $formDirigeant->isValid()) {
            if (!$dirigeants->getId()) {
                $dirigeants->setCreatedAt(new \Datetime());
            }
            $dirigeants->setUpdatedAt(new \Datetime());

            {{ dump($dirigeants); }}

            $manager->persist($dirigeants);
            $manager->flush();

            return $this->redirectToRoute('dirigeant');
        }

        return $this->render('dirigeant/add.html.twig', [
            'controller_name' => 'DirigeantController',
            'page_title' => 'création dirigeant',
            'isEdit' => $isEdit,
            'formDirigeant' => $formDirigeant->createView()
        ]);
    }

    /**
     * @Route("dirigeant/delete/{id}", name="delete_dirigeant")
     */
    public function deleteDirigeant(Request $request,
                                        EntityManagerInterface $manager,
                                        Dirigeant $dirigeant): Response
    {
        $manager->remove($dirigeant);
        $manager->flush();
        $this->addFlash('danger', 'élement a été supprimé');
        
        return $this->redirectToRoute('dirigeant');
    }
}
