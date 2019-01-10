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
     * @Route("/", name="category_admin_index", methods="GET")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {

        return $this->render('category_admin/index.html.twig', [
            'categories' => $categoryRepository->findAll()]);
    }
    /**
     * @Route("/new", name="category_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category_admin/new.html.twig', [
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

     /**
     * @Route("/{id}", name="category_admin_delete", methods="DELETE")
     */
    public function delete(Request $request, Category $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }

            return $this->redirectToRoute('category_admin_index');
    }
}
