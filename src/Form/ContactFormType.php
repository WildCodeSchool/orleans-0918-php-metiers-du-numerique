<?php

namespace App\Form;

use App\Entity\ContactForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'Prénom'
            ])
            ->add('lastname', TextType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'Nom'
            ])
            ->add('companyOrLearningCenter', TextType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'Nom de votre entreprise ou de votre organisme de formation',
                'required' => false
            ])
            ->add('mail', EmailType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'Email'
            ])
            ->add('message', TextareaType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'Votre message'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class,
        ]);
    }
}
