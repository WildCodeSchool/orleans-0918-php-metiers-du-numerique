<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\CompanyRepository;
use App\Repository\LearningCenterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeAdminController extends AbstractController
{
    /**
     * @Route("/admin/", name="home_admin")
     */
    public function index(
        CompanyRepository $companyRepository,
        CommentRepository $commentRepository,
        LearningCenterRepository $learningCenterRepository
    ) {
        $companies = $companyRepository->companyCount();
        $comments = $commentRepository->commentAdminCount();
        $learningCenters = $learningCenterRepository->learningCenterCount();

        return $this->render('home_admin/index.html.twig', [
            'controller_name' => 'HomeAdminController',
            'companies'=>$companies,
            'comments'=>$comments,
            'learningCenters'=>$learningCenters
        ]);
    }
}
