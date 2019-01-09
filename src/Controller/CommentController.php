<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Job;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\DateTimeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comment")
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/addlike/{comment}", name="add_like", methods="POST")
     */
    public function addLike(Comment $comment, SessionInterface $session)
    {

        if (!($session->get('like'.$comment->getId()) == true)) {
            $session->set("like".$comment->getId(), true);
            $comment->setLiked($comment->getLiked() + 1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }
        return $this->render('comment/_like.html.twig', ['comment' => $comment]);
    }

    /**
     * @Route("/", name="comment_index", methods="GET")
     */
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('comment/index.html.twig', ['comments' => $commentRepository->findAll()]);
    }

    /**
     * @Route("/new/{job_id}", name="comment_new", methods="GET|POST")
     * @ParamConverter("job", options={"id" = "job_id"})
     */
    public function new(Request $request, Job $job): Response
    {
        $comment = new Comment();
        $comment->setAssociatedJob($job);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $comment->setPostDate(new \DateTime());
            $comment->setAccepted(false);
            $comment->setLiked(0);
            $em->flush();

            return $this->redirectToRoute('job_show', array('id' => $job->getId()));
        }

        return $this->render('comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
            'searchForm' =>
                SearchFormTrait::getForm($request, $this->get('form.factory'), $this->get('router'))->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_show", methods="GET")
     */
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment
        ]);
    }

    /**
     * @Route("/{id}/edit", name="comment_edit", methods="GET|POST")
     */
    public function edit(Request $request, Comment $comment): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comment_index', ['id' => $comment->getId()]);
        }

        return $this->render('comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_delete", methods="DELETE")
     */
    public function delete(Request $request, Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete' . $comment->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comment);
            $em->flush();
        }

        return $this->redirectToRoute('comment_index');
    }
}
