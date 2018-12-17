<?php
/**
 * Created by PhpStorm.
 * User: wilder17
 * Date: 17/12/18
 * Time: 11:11
 */

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\JobRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

trait SearchFormTrait
{
    /**
     * @param Request $request
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     * @param string $formClass
     * @return FormInterface
     */
    public function getForm(
        Request $request,
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        string $formClass = SearchType::class
    ) : FormInterface {
        $form = $formFactory->create(
            $formClass,
            null,
            [
            'method' => Request::METHOD_GET,
            'action' => $router->generate('job_search'),]
        );

        $form->handleRequest($request);
        return $form;
    }

    /**
     * @param FormInterface $form
     * @param JobRepository $jobRepository
     * @return array|mixed
     */
    public function getData(FormInterface $form, JobRepository $jobRepository)
    {
        $jobs = [];

        if ($form->isSubmitted()) {
            $data = $form->getData();
            $jobs = $jobRepository->search($data['search']);
        }

        return $jobs;
    }
}
