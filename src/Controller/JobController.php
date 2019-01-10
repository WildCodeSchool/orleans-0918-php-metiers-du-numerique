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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     * @Route("/{id}", name="job_show", methods="GET|POST")
     */
    public function show(Job $job, Request $request, SessionInterface $session): Response
    {
        $comments= $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findBy(
                ['associatedJob'=>$job->getId(),'accepted' =>true],
                ['liked'=>'DESC']
            );

        return $this->render('job/show.html.twig', ['job' => $job,
            'comments'=>$comments,
            'searchForm' =>
                SearchFormTrait::getForm($request, $this->get('form.factory'), $this->get('router'))->createView(),
        ]);
    }
}
