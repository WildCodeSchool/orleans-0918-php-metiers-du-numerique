<?php

namespace App\Form;

use App\Entity\ContactForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
            ->add('author', TextType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'Nom'
            ])
            ->add('link', TextType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'url de l\'organisme de formation ou de l\'entreprise',
                'required' => false
            ])
            ->add('subject', TextType::class, [
                'attr' => array('type' => 'text', 'class' => 'color-input'),
                'label' => 'Objet du mail'
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
