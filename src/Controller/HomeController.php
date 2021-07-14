<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\DirigeantRepository;
use App\Repository\SocieteRepository;
use App\Repository\VilleRepository;
use App\Entity\Dirigeant;
use App\Entity\Societe;
use App\Form\DirigeantType;
use App\Form\SocieteType;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(DirigeantRepository $repoDirigeant,
                            SocieteRepository $repoSociete,
                            VilleRepository $repoVille,
                            Request $request,
                            EntityManagerInterface $manager,
                            Dirigeant $dirigeants = null,
                            Societe $societes = null): Response
    {
        $isEdit = true;

        if (!$dirigeants) {
            $dirigeants = new Dirigeant();
            $isEdit = false;
        }

        if (!$societes) {
            $societes = new Societe();
            $isEdit = false;
        }

        $formDirigeant = $this->createForm(DirigeantType::class, $dirigeants);
        $formDirigeant->handleRequest($request);

        $formSociete = $this->createForm(SocieteType::class, $societes);
        $formSociete->handleRequest($request);

        if ($formDirigeant->isSubmitted() && $formDirigeant->isValid()) {
            if (!$dirigeants->getId()) {
                $dirigeants->setCreatedAt(new \Datetime());
            }
            $dirigeants->setUpdatedAt(new \Datetime());

            {{ dump($dirigeants); }}

            $manager->persist($dirigeants);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        if ($formSociete->isSubmitted() && $formSociete->isValid()) {
            if (!$societes->getId()) {
                $societes->setCreatedAt(new \Datetime);
            }
            $societes->setUpdatedAt(new \DateTime());

            $manager->persist($societes);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        $baseUrl = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'page_title' => 'Ajout des informations',
            'dirigeants' => $repoDirigeant->findAll(),
            'societes' => $repoSociete->findAll(),
            'isEdit' => $isEdit,
            'baseUrl' =>  $baseUrl,
            'formDirigeant' => $formDirigeant->createView(),
            'formSociete' => $formSociete->createView()
        ]);
    }

    /**
     * @Route("/ajout-liste", name="add_list")
     * @Route("/edit-liste/{id}", name="edit_list")
     */
    public function formsListe(DirigeantRepository $repoDirigeant,
                                    SocieteRepository $repoSociete,
                                    Request $request,
                                    EntityManagerInterface $manager,
                                    Dirigeant $dirigeants = null,
                                    Societe $societes = null): Response
    {
        $isEdit = true;

        if (!$dirigeants) {
            $dirigeants = new Dirigeant();
            $isEdit = false;
        }

        if (!$societes) {
            $societes = new Societe();
            $isEdit = false;
        }

        $formDirigeant = $this->createForm(DirigeantType::class, $dirigeants);
        $formDirigeant->handleRequest($request);

        $formSociete = $this->createForm(SocieteType::class, $societes);
        $formSociete->handleRequest($request);

        if ($formDirigeant->isSubmitted() && $formDirigeant->isValid()) {
            if (!$dirigeants->getId()) {
                $dirigeants->setCreatedAt(new \Datetime());
            }
            $dirigeants->setUpdatedAt(new \Datetime());

            $manager->persist($dirigeants);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        if ($formSociete->isSubmitted() && $formSociete->isValid()) {
            if (!$societes->getId()) {
                $societes->setCreatedAt(new \Datetime);
            }
            $societes->setUpdatedAt(new \DateTime());

            $manager->persist($societes);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('/home/index.html.twig', [
            'controller_name' => 'HomeController',
            'page_title' => 'Création liste',
            'isEdit' => $isEdit,
            'formDirigeant' => $formDirigeant->createView(),
            'formSociete' => $formSociete->createView()
        ]);
    }

    /**
     * @Route("/home/delete-dirigeant/{id}", name="h_delete_dirigeant")
     */
    public function deleteDirigeant(Request $request,
                                        EntityManagerInterface $manager,
                                        Dirigeant $dirigeant): Response
    {
        $manager->remove($dirigeant);
        $manager->flush();
        $this->addFlash('danger', 'élement a été supprimé');
        
        return $request;
    }
}
