<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Positive;

class GeneratorFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numberOfCodes', IntegerType::class, [
                'constraints' => [
                    new Positive(),
                ],
            ])
            ->add('lengthOfCode', IntegerType::class, [
                'constraints' => [
                    new Positive(),
                ],
            ])
            ->add('generate', SubmitType::class)
        ;
    }
}
