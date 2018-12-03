<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Job;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/comment")
 */


class CommentAdminController extends AbstractController
{
    /**
     * @Route("/", name="comment_admin")
     */
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('comment_admin/index.html.twig', [
            'comments' => $commentRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}", name="comment_admin_show", methods="GET")
     */
    public function show(Comment $comment): Response
    {
        return $this->render('comment_admin/show.html.twig', [
            'comment'=>$comment,
            'job'=>$comment->getAssociatedJob(),
        ]);
    }
}
