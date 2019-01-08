<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use App\Repository\JobRepository;
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
    public function index(JobRepository $jobRepository)
    {
        return $this->render('job_admin/index.html.twig', ['jobs' => $jobRepository->findAll()]);
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
    /**
     * @Route("/{id}", name="job_admin_delete", methods="DELETE")
     */
    public function delete(Request $request, Job $job): Response
    {
        if ($this->isCsrfTokenValid('delete'.$job->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($job);
            $em->flush();
        }

        return $this->redirectToRoute('job_admin');
    }
    /**
     * @Route("/{id}/edit", name="job_admin_edit", methods="GET|POST")
     */
    public function edit(Request $request, Job $job): Response
    {
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_admin', ['id' => $job->getId()]);
        }

        return $this->render('job_admin/edit.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }
}
