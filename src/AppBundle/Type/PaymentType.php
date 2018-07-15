<?php

namespace AppBundle\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class PaymentType.
 */
class PaymentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cardNumber', TextType::class, [
                'constraints' => [new NotBlank(), new Length(['max' => 25])],
            ])
            ->add('cardHolder', TextType::class, [
                'constraints' => [new NotBlank(), new Length(['max' => 50])],
            ])
            ->add('cardExpMonth', TextType::class, [
                'constraints' => [new NotBlank(), new Length(['min' => 2, 'max' => 2])],
            ])
            ->add('cardExpYear', TextType::class, [
                'constraints' => [new NotBlank(), new Length(['min' => 4, 'max' => 4])],
            ])
            ->add('cardCvv', TextType::class, [
                'constraints' => [new NotBlank(), new Length(['min' => 3, 'max' => 4])],
            ])
            ->add('cardCvv', TextType::class, [
                'constraints' => [new NotBlank(), new Length(['min' => 3, 'max' => 4])],
            ])
            ->add('customerEmail', TextType::class, [
                'constraints' => [new NotBlank(), new Email()],
            ])
            ->add('Pay', SubmitType::class);
    }
}
