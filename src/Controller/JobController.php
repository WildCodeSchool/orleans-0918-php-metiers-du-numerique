<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\Comment;
use App\Form\JobType;
use App\Repository\CategoryRepository;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/job")
 */
class JobController extends AbstractController
{
    /**
     * SearchFormTrait
     */
    use SearchFormTrait;

    /**
     * @Route("/", name="job_index", methods="GET")
     */
    public function index(CategoryRepository $categoryRepository, Request $request): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('job/index.html.twig', [
            'categories' => $categories,
            'searchForm' =>
                SearchFormTrait::getForm($request, $this->get('form.factory'), $this->get('router'))->createView(),
                ]);
    }


    /**
     * @Route("/search", name="job_search", methods="GET")
     */
    public function search(Request $request, JobRepository $jobRepository, CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        $form = SearchFormTrait::getForm($request, $this->get('form.factory'), $this->get('router'));
        $jobs = SearchFormTrait::getData($form, $jobRepository);

        return $this->render('job/search.html.twig', [
            'searchForm' => $form->createView(),
            'jobs' => $jobs,
            'categories'=>$categories
        ]);
    }

    /**
     * @Route("/new", name="job_new", methods="GET|POST")
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

        return $this->render('job/new.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_show", methods="GET")
     */
    public function show(Job $job, Request $request): Response
    {

        $comments= $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findBy(
                ['associatedJob'=>$job->getId()],
                ['id'=>'ASC'],
                3,
                0
            );

        return $this->render('job/show.html.twig', ['job' => $job,
            'comments'=>$comments,
            'searchForm' =>
                SearchFormTrait::getForm($request, $this->get('form.factory'), $this->get('router'))->createView(),
        ]);
    }
    /**
     * @Route("/{id}/edit", name="job_edit", methods="GET|POST")
     */
    public function edit(Request $request, Job $job): Response
    {
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('job_index', ['id' => $job->getId()]);
        }

        return $this->render('job/edit.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_delete", methods="DELETE")
     */
    public function delete(Request $request, Job $job): Response
    {
        if ($this->isCsrfTokenValid('delete'.$job->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($job);
            $em->flush();
        }

        return $this->redirectToRoute('job_index');
    }
}
