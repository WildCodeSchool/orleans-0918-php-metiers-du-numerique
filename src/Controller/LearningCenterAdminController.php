<?php
/**
 * Created by PhpStorm.
 * User: wilder13
 * Date: 04/12/18
 * Time: 11:16
 */

namespace App\Controller;

use App\Entity\Job;
use App\Entity\LearningCenter;
use App\Form\LearningCenterType;
use App\Repository\LearningCenterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        /**
         * @Route("/{id}", name="learning_center_show", methods="GET")
         */
        public function show(LearningCenter $learningCenter): Response
        {
            return $this->render('learning_center_admin/show.html.twig', ['learning_center' => $learningCenter]);
        }
    }
