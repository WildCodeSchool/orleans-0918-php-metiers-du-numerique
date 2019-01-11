<?php

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
 * @Route("/learningCenter")
 */
class LearningCenterController extends AbstractController
{
    /**
     * @Route("/new", name="learning_center_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $learningCenter = new LearningCenter();
        $form = $this->createForm(LearningCenterType::class, $learningCenter);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($learningCenter);
            $em->flush();

            return $this->redirectToRoute('learning_center_new');
        }

        return $this->render('learning_center/new.html.twig', [
            'learning_center' => $learningCenter,
            'form' => $form->createView(),
            'searchForm' =>
                SearchFormTrait::getForm($request, $this->get('form.factory'), $this->get('router'))->createView(),
        ]);
    }
}
