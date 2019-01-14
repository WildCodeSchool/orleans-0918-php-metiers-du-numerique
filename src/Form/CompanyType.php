<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Company;
use App\Entity\Job;
use App\Repository\JobRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => "Nom de votre entreprise",
            ])
            ->add('pictureFile', VichImageType::class, [
                'required' => false,
                'download_link' => false,
                'image_uri' => false,
                'allow_delete' => false,
                'label' => ' ',
                'attr' => array('aria-describedby' => 'fileHelp', 'class' => 'form-control-file')
            ])
            ->add('mail', TextType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'Adresse mail de votre entreprise',
            ])
            ->add('link', TextType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'Lien du site de votre entreprise',

            ])
            ->add('jobs', EntityType::class, [
                'group_by' => function ($choiceValue) {
                    return $choiceValue->getAssociatedCategory()->getName();
                },
                'class' => Job::class,
                'choice_label' => 'name',
                'label' => 'Sélectionnez la ou les fiches métiers qui correspondent à votre entreprise ',
                'multiple' => true,
                'expanded' => false,
                'attr' => [
                    'class' => 'jobs color-input form-control',
                    'type' => 'text',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
