<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Job;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $currentDate = new \DateTime();
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('picture')
            ->add('mail')
            ->add('job')
            ->add('business')
            ->add('prosComment')
            ->add('consComment')
            ->add('comment')
            ->add('liked')
            ->add('accepted')
            ->add('associatedJob', EntityType::class, [
                'class' => Job::class,
                'choice_label' => 'name'
            ])
            ->add('postDate', DateTimeType::class, array(
                'data' => $currentDate,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
