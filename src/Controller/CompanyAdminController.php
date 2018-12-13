<?php

namespace App\Controller;

use App\Entity\Category;
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
     * @Route("/new", name="company_admin_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $categoryRepository= $this->getDoctrine()
            ->getRepository(Category::class);
        $categories = $categoryRepository->findAll();
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);
        $company->setAccepted(true);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();
            return $this->redirectToRoute('company_admin_new');
        }
        return $this->render('company_admin/new.html.twig', [
            'company' => $company,
            'categories'=>$categories,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_show", methods="GET")
     */
    public function show(Company $company): Response
    {
        return $this->render('company_admin/show.html.twig', ['company' => $company]);
    }
    /**
     * @Route("/{id}", name="company_admin_delete", methods="DELETE")
     */
    public function delete(Request $request, Company $company): Response
    {
        if ($this->isCsrfTokenValid('delete'.$company->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($company);
            $em->flush();
        }

        return $this->redirectToRoute('compagny_admin');
    }
}
