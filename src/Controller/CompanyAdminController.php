<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/company")
 */


class CompanyAdminController extends AbstractController
{
    /**
     * @Route("/", name="compagny_admin")
     */
    public function index(CompanyRepository $compagnyRepository): Response
    {
        return $this->render('company_admin/index.html.twig', [
            'companies' => $compagnyRepository->findBy([], ['accepted'=>'ASC'])
        ]);
    }

    /**
     * @Route("/new", name="company_admin_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('company_admin_index');
        }

        return $this->render('company_admin/new.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_admin_show", methods="GET")
     */
    public function show(Company $company): Response
    {
        return $this->render('company_admin/show.html.twig', ['company' => $company]);
    }



}
