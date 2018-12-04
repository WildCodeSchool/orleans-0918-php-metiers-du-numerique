<?php

namespace App\Controller;

use App\Entity\LearningCenter;
use App\Repository\LearningCenterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/learningCenter")
 */


class LearningCenterAdminController extends AbstractController
{
    /**
     * @Route("/", name="learningCenter_admin")
     */
    public function index(LearningCenterRepository $learningCenterRepository): Response
    {
        return $this->render('learning_center_admin/index.html.twig', [
            'learningCenters' => $learningCenterRepository->findAll()
        ]);
    }
}
