<?php
/**
 * Created by PhpStorm.
 * User: billyvivant
 * Date: 07/01/19
 * Time: 14:42
 */

namespace App\Controller;

use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}