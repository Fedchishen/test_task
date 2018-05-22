<?php

namespace ListOf\EmployeesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ListOf\EmployeesBundle\Entity\Employees;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class EmployeesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('first_name')->add('middle_name')->add('surname')->add('position_id')
                ->add('date_of_employment')->add('wages')->add('chief_id')
                ->add('photo', FileType::class, array('label' => 'Photo (png/jpeg/jpg/gif file)',
                    'data_class' => null));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Employees::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'listof_employeesbundle_employees';
    }


}
