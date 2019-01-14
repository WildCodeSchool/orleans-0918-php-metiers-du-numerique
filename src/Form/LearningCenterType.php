<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\LearningCenter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class LearningCenterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array( 'class' => 'color-input'),
                'label' => 'Nom de l\'organisme de Formation',
            ])
            ->add('pictureFile', VichImageType::class, [
                'required' => false,
                'download_link' => false,
                'image_uri' => false,
                'allow_delete' => false,
                'label' => ' ',
                'attr' => array( 'class' => 'form-control-file')
            ])
            ->add('mail', TextType::class, [
                'attr' => array( 'class' => 'color-input'),
                'label' => 'Adresse mail de l\'organisme de Formation',
            ])
            ->add('link', TextType::class, [
                'attr' => array( 'class' => 'color-input'),
                'label' => 'Lien du site de formation',

            ])
            ->add('jobs', EntityType::class, [
                'group_by' => function ($choiceValue) {
                    return $choiceValue->getAssociatedCategory()->getName();
                },
                'class' => Job::class,
                'choice_label' => 'name',
                'label' => 'Sélectionnez la ou les fiches métiers qui correspondent à votre Formation ',
                'multiple' => true,
                'expanded' => false,
                'attr' => [
                    'class' => 'jobs color-input form-control',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LearningCenter::class,
        ]);
    }
}
