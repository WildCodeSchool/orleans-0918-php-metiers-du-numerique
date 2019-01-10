<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 28/11/18
 * Time: 09:47
 */

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/category")
 */
class CategoryAdminController extends AbstractController
{
    /**
     * @Route("/", name="category_admin_index", methods="GET|POST")
     */
    public function index(
        CategoryRepository $categoryRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            $this->addFlash('success', 'La catégorie a bien été ajouté');
            return $this->redirectToRoute('category_admin_index');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('danger', 'La catégorie n\'a pas pu être ajouté');
        }
        $pagination = $paginator->paginate(
            $categoryRepository->findAll(),
            $request->query->getInt('page', 1),
            $this->getParameter('elements_by_page')
        );
        return $this->render('category_admin/index.html.twig', [
            'categories' => $pagination,
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_admin_show", methods="GET")
     */
    public function show(Request $request, Category $category): Response
    {
        return $this->render('category_admin/show.html.twig', [
            'category' => $category,
        ]);
    }
}
