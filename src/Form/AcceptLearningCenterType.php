<?php
/**
 * Created by PhpStorm.
 * User: billyvivant
 * Date: 12/12/18
 * Time: 16:14
 */

namespace App\Form;

use App\Entity\LearningCenter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AcceptLearningCenterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accepted',SubmitType::class, array(
                'attr' => array('class' => 'btn')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LearningCenter::class,
        ]);
    }
}
