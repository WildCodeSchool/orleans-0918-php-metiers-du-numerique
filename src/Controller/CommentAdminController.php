<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Job;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
        ]);
    }

    /**
     * @Route("/{id}", name="comment_admin_delete", methods="DELETE")
     */
    public function delete(Request $request, Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comment);
            $em->flush();
        }

        return $this->redirectToRoute('comment_admin');
    }

}

