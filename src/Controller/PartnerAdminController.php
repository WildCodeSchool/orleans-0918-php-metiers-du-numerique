<?php
/**
 * Created by PhpStorm.
 * User: billyvivant
 * Date: 07/01/19
 * Time: 14:42
 */

namespace App\Controller;

use App\Repository\PartnerRepository;
use Knp\Component\Pager\PaginatorInterface;
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
    public function index(
        PartnerRepository $partnerRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $pagination = $paginator->paginate(
            $partnerRepository->findAll(),
            $request->query->getInt('page', 1),
            $this->getParameter('elements_by_page')
        );
        return $this->render('partner_admin/index.html.twig', ['partners' => $pagination
        ]);
    }
}
