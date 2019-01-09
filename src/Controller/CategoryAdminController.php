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
    public function index(CategoryRepository $categoryRepository, Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('category_admin_index');
        }

        return $this->render('category_admin/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
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
