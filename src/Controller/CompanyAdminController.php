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
     * @Route("/{id}", name="company_show", methods="GET")
     */
    public function show(Company $company): Response
    {
        return $this->render('company_admin/show.html.twig', ['company' => $company]);
    }
}
