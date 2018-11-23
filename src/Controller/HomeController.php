<?php

namespace App\Controller;

use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\PartnerController;
use App\Entity\Partner;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PartnerRepository $partnerRepository)
    {
        return $this->render('home/index.html.twig', ['partners' => $partnerRepository->findAll()]);
    }
}
