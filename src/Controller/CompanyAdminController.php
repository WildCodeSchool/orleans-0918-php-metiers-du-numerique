<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Company;
use App\Form\AcceptCompanyType;
use App\Form\CompanyType;
use App\Repository\CategoryRepository;
use App\Repository\CompanyRepository;
use Knp\Component\Pager\PaginatorInterface;
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
     * @Route("/", name="company_admin", methods="GET" )
     */
    public function index(
        CompanyRepository $companyRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $pagination = $paginator->paginate(
            $companyRepository->findAll(),
            $request->query->getInt('page', 1),
            1
        );
        return $this->render('company_admin/index.html.twig', [
            'companies' => $pagination
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
        $company->setAccepted(true);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();
            $this->addFlash('success', 'L\'entreprise a bien été ajouté');
            return $this->redirectToRoute('company_admin');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('danger', 'L\'entreprise n\'a pas pu être ajouté');
        }
        return $this->render('company_admin/new.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_show", methods="GET|POST")
     */
    public function show(Request $request, Company $company): Response
    {
        $form = $this->createForm(AcceptCompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $company->setAccepted(!$company->getAccepted());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('company_admin', ['id' => $company->getId()]);
        }

        return $this->render('company_admin/show.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/edit", name="company_admin_edit", methods="GET|POST")
     */
    public function edit(Request $request, Company $company): Response
    {
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('company_admin', ['id' => $company->getId()]);
        }

        return $this->render('company_admin/edit.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
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

        return $this->redirectToRoute('company_admin');
    }
}
