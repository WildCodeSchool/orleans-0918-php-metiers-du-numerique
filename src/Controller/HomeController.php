<?php

namespace App\Controller;

use App\Entity\Job;
use App\Repository\JobRepository;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\PartnerController;
use App\Entity\Partner;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods="GET")
     */
    public function index(PartnerRepository $partnerRepository, JobRepository $jobRepository, Request $request)
    {
        $job = $jobRepository->findOneBy([], ['video' => "DESC"]);
        $partners = $partnerRepository->findAll();
        $nbPartners = count($partners);
        if ($nbPartners <= 5 && $nbPartners > 0) {
            $nbSlideToAdd = 6 - $nbPartners;
            for ($i = 0; $i < $nbSlideToAdd; $i++) {
                array_push($partners, $partners[$i]);
            }
        }
        return $this->render('home/index.html.twig', [
            'partners' => $partners,
            'job' => $job,
            'searchForm' =>
                SearchFormTrait::getForm($request, $this->get('form.factory'), $this->get('router'))->createView(),
        ]);
    }
}
