<?php
/**
 * Created by PhpStorm.
 * User: wilder13
 * Date: 04/12/18
 * Time: 11:16
 */

namespace App\Controller;

use App\Entity\LearningCenter;
use App\Form\AcceptLearningCenterType;
use App\Form\LearningCenterType;
use App\Repository\LearningCenterRepository;
use Knp\Component\Pager\PaginatorInterface;
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
    public function index(
        LearningCenterRepository $learningCenterRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $pagination = $paginator->paginate(
            $learningCenterRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('learning_center_admin/index.html.twig', [
            'learningCenters' => $pagination
        ]);
    }

    /**
     * @Route("/new", name="learningCenter_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $learningCenter = new LearningCenter();
        $form = $this->createForm(LearningCenterType::class, $learningCenter);
        $form->handleRequest($request);
        $learningCenter->setAccepted(true);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($learningCenter);
            $em->flush();

            return $this->redirectToRoute('learningCenter_admin');
        }

        return $this->render('learning_center_admin/new.html.twig', [
            'learning_center' => $learningCenter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="learning_center_show", methods="GET|POST")
     */
    public function show(Request $request, LearningCenter $learningCenter): Response
    {
        $form = $this->createForm(AcceptLearningCenterType::class, $learningCenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $learningCenter->setAccepted(!$learningCenter->getAccepted());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('learningCenter_admin', ['id' => $learningCenter->getId()]);
        }

        return $this->render('learning_center_admin/show.html.twig', [
            'learning_center' => $learningCenter,
            'form' => $form->createView(),
            ]);
    }
    /**
     * @Route("/{id}", name="learning_center_admin_delete", methods="DELETE")
     */
    public function delete(Request $request, LearningCenter $learningCenter): Response
    {
        if ($this->isCsrfTokenValid('delete' . $learningCenter->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($learningCenter);
            $em->flush();
        }

        return $this->redirectToRoute('learningCenter_admin');
    }
}
