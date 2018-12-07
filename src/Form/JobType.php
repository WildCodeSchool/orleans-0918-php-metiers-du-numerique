<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Job;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('associatedCategory', EntityType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Catégorie associée à cette fiche métier',
            ])
            ->add('name', TextType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'Nom de la fiche métier',
                ])
            ->add('video', TextType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'Lien de la vidéo',
                'required'=>false,
            ])
            ->add('pictureFile', VichImageType::class, [
                'required' => true,
                'download_link' => false,
                'allow_delete' => false
            ])
            ->add('description', TextareaType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'Description de la fiche métier',
            ])
            ->add('videoDescription', TextareaType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'Description de la vidéo',
                'required'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
