<?php

namespace App\Form;

use App\Entity\Partner;
use function PHPSTORM_META\type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'attr'=> array('aria-label'=>'Amount (to the nearest dollar)','type'=>'text')
            ))
            ->add('url', TextType::class, array(
                'attr'=> array('aria-label'=>'Amount (to the nearest dollar)','type'=>'text')))
            ->add('pictureFile',VichImageType::class, array(
                'required' => true,
                'download_link' => false,
                'allow_delete' => false,
                'attr'=>array('id'=>"exampleInputFile",'aria-describedby'=>'fileHelp','class'=>'form-control-file')
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
        ]);
    }
}
