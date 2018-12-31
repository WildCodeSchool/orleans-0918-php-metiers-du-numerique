<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Job;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $currentDate = new \DateTime();
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr'=> ['class' => 'color-input']
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr'=> ['class' => 'color-input']
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Email',
                'attr'=> ['class' => 'color-input']
            ])
            ->add('job', TextType::class, [
                'label' => 'Votre travail',
                'attr'=> ['class' => 'color-input']
            ])
            ->add('company', TextType::class, [
                'label' => "Votre entreprise",
                'attr'=> ['class' => 'color-input'],
                'required'=>false
            ])
            ->add('prosComment', TextareaType::class, [
                'label' => 'Les avantanges du métier',
                'attr'=> ['class' => 'color-input']
            ])
            ->add('consComment', TextareaType::class, [
                'label' => 'Les inconvénients du métier',
                'attr'=> ['class' => 'color-input']
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Commentaire Divers',
                'attr'=> ['class' => 'color-input'],
                'required'=>false
            ])
            ->add('associatedJob', EntityType::class, [
                'class' => Job::class,
                'choice_label' => 'name',
                'label'=>false,
                'disabled'=>true,
                'attr'=> ['class' => 'd-none']
            ])
            ->add('pictureFile', VichImageType::class, [
                'required' => true,
                'download_link' => false,
                'allow_delete' => false,
                'label' => ' ',
                'download_label' => false,
                'attr' => array('aria-describedby' => 'fileHelp', 'class' => 'form-control-file')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
