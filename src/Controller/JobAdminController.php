<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use App\Repository\JobRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/job")
 */

class JobAdminController extends AbstractController
{
    /**
     * @Route("/", name="job_admin")
     */
    public function index(
        JobRepository $jobRepository,
        PaginatorInterface $paginator,
        Request $request) : Response {

        $pagination = $paginator->paginate(
            $jobRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('job_admin/index.html.twig', [
            'jobs' => 'JobAdminController',
        ]);
    }
    /**
     * @Route("/new", name="job_admin_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            return $this->redirectToRoute('job_index');
        }

        return $this->render('job_admin/new.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }
}
