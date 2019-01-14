<?php

namespace App\Controller;

use App\Entity\LegalNotice;
use App\Form\LegalNoticeType;
use App\Repository\LegalNoticeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalNoticeController extends AbstractController
{

    public function index(LegalNoticeRepository $legalNoticeRepository): Response
    {
        $legalNotice = $legalNoticeRepository->findOneBy([], ['id' => "ASC"]);
        return $this->render('legal_notice/index.html.twig', ['legalNotice' => $legalNotice]);
    }

    /**
     * @Route("admin/legal/notice", name="legal_notice_admin", methods="GET")
     */
    public function indexAdmin(LegalNoticeRepository $legalNoticeRepository ): Response
    {
        $legalNotice = $legalNoticeRepository->findOneBy([], ['id' => "ASC"]);
        return $this->render('legal_notice_admin/index.html.twig', ['legalNotice' => $legalNotice]);
    }

    /**
     * @Route("admin/legal/notice/{id}/edit", name="legal_notice_edit", methods="GET|POST")
     */
    public function edit(Request $request, LegalNotice $legalNotice ): Response
    {
        $form = $this->createForm(LegalNoticeType::class, $legalNotice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('legal_notice_index', ['id' => $legalNotice->getId()]);
        }

        return $this->render('legal_notice_admin/edit.html.twig', [
            'legal_notice' => $legalNotice,
            'form' => $form->createView(),
        ]);
    }
}
