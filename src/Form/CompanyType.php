<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Job;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('pictureFile', VichImageType::class, [
                'required' => true,
                'download_link' => false,
                'allow_delete' => false,
                'label' => ' ',
                'attr' => array('aria-describedby' => 'fileHelp', 'class' => 'form-control-file')
            ])
            ->add('mail')
            ->add('link')
            ->add('jobs', EntityType::class, [
                'class'=>Job::class,
                'choice_label'=>'name',
                'by_reference' => false,
                'multiple' => true,
                'expanded' => true,
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
