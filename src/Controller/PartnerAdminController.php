<?php
/**
 * Created by PhpStorm.
 * User: billyvivant
 * Date: 07/01/19
 * Time: 14:42
 */

namespace App\Controller;

use App\Entity\Partner;
use App\Form\PartnerType;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/partner")
 */
class PartnerAdminController extends AbstractController
{
    /**
     * @Route("/", name="partner_admin_index", methods="GET")
     */
    public function index(PartnerRepository $partnerRepository): Response
    {
        return $this->render('partner_admin/index.html.twig', ['partners' => $partnerRepository->findAll()]);
    }

    /**
     * @Route("/new", name="partner_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $partner = new Partner();
        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partner);
            $em->flush();

            $this->addFlash('success', 'Le partenaire a bien été ajouté');
            return $this->redirectToRoute('partner_admin_index');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('danger', 'Le partenaire n\'a pas pu être ajouté');
        }

        return $this->render('partner/new.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
        ]);
    }
}
