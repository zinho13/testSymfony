<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\VilleRepository;
use App\Entity\Ville;
use App\Form\VilleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VilleController extends AbstractController
{
    /**
     * @Route("/ville", name="ville")
     */
    public function index(VilleRepository $repoVille): Response
    {
        return $this->render('ville/index.html.twig', [
            'controller_name' => 'VilleController',
            'page_title' => 'Liste des villes',
            'villes' => $repoVille->findAll()
        ]);
    }

    /**
     * @Route("/ville/ajout", name="add_ville")
     * @Route("/ville/edit/{id}", name="edit_ville")
     */
    public function formsVille(VilleRepository $repoVille,
                                    Request $request,
                                    EntityManagerInterface $manager,
                                    Ville $villes = null): Response
    {
        $isEdit = true;

        if (!$villes) {
            $villes = new Ville();
            $isEdit = false;
        }

        $formVille = $this->createForm(VilleType::class, $villes);
        $formVille->handleRequest($request);

        if ($formVille->isSubmitted() && $formVille->isValid()) {
            if (!$villes->getId()) {
                $villes->setCreatedAt(new \Datetime);
            }
            $villes->setUpdatedAt(new \DateTime());

            $manager->persist($villes);
            $manager->flush();

            return $this->redirectToRoute('ville');
        }
        return $this->render('ville/add.html.twig', [
            'controller_name' => 'VilleController',
            'page_title' => 'création code postal',
            'isEdit' => $isEdit,
            'formVille' => $formVille->createView()
        ]);
    }

    /**
     * @Route("/ville/delete/{id}", name="delete_ville")
     */
    public function deleteVille(Request $request, EntityManagerInterface $manager,
                                    Ville $ville): Response
    {
        $manager->remove($ville);
        $manager->flush();
        $this->addFlash('danger', 'élement a été supprimé');
        
        return $this->redirectToRoute('ville');
    }

    /**
     * @Route("/ville/findVilleCode/{idCodePostal}", name="ville_by_code")
     */
    public function findVilleCode(VilleRepository $repoVille, $idCodePostal): Response
    {   
        $villes = $repoVille->findVilleByCodePostal($idCodePostal);

        return $this->render('ville/villeByCode.html.twig', [
            'page_title' => '',
            'villeCodes' => $villes
        ]);
    }
}
