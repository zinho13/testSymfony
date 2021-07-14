<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\CodePostalRepository;
use App\Entity\CodePostal;
use App\Form\CodePostalType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CodePostalController extends AbstractController
{
    /**
     * @Route("/code-postal", name="code_postal")
     */
    public function index(CodePostalRepository $repoCodePostal): Response
    {
        return $this->render('code_postal/index.html.twig', [
            'controller_name' => 'CodePostalController',
            'page_title' => 'Liste des codes postal',
            'codePostals' => $repoCodePostal->findAll()
        ]);
    }

    /**
     * @Route("/code-postal/ajout", name="add_code_postal")
     * @Route("/code-postal/edit/{id}", name="edit_code_postal")
     */
    public function formsCodePostal(CodePostalRepository $repoCodePostal,
                                    Request $request,
                                    EntityManagerInterface $manager,
                                    CodePostal $codepostals = null): Response
    {
        $isEdit = true;

        if (!$codepostals) {
            $codepostals = new CodePostal();
            $isEdit = false;
        }

        $formCodePostal = $this->createForm(CodePostalType::class, $codepostals);
        $formCodePostal->handleRequest($request);

        if ($formCodePostal->isSubmitted() && $formCodePostal->isValid()) {
            if (!$codepostals->getId()) {
                $codepostals->setCreatedAt(new \DateTime());
            }
            $codepostals->setUpdatedAt(new \DateTime());

            $manager->persist($codepostals);
            $manager->flush();

            return $this->redirectToRoute('code_postal');
        }
        return $this->render('code_postal/add.html.twig', [
            'controller_name' => 'CodePostalController',
            'page_title' => 'création code postal',
            'isEdit' => $isEdit,
            'formCodePostal' => $formCodePostal->createView()
        ]);
    }

    /**
     * @Route("/code-postal/delete/{id}", name="delete_code_postal")
     */
    public function deleteCodePostal(Request $request, EntityManagerInterface $manager,
                                    CodePostal $codePostal): Response
    {
        $manager->remove($codePostal);
        $manager->flush();
        $this->addFlash('danger', 'élement a été supprimé');
        
        return $this->redirectToRoute('code_postal');
    }
}
