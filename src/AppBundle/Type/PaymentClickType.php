<?php

namespace AppBundle\Type;

use AppBundle\Entity\CardToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class PaymentType.
 */
class PaymentClickType extends AbstractType
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $tokens = $this->em->getRepository(CardToken::class)->findAll();

        $builder
            ->add('recurringToken', ChoiceType::class, [
                'constraints' => [new NotBlank()],
                'choices' => $tokens,
                'choice_value' => function (CardToken $entity = null) {
                    return $entity ? $entity->getToken() : '';
                },
                'choice_label' => function (CardToken $entity = null) {
                    return $entity ? $entity->getToken() : '';
                },
            ])
            ->add('customerEmail', TextType::class, [
                'constraints' => [new NotBlank(), new Email()],
            ])
            ->add('Pay', SubmitType::class);
    }

    /**
     * @param EntityManagerInterface $em
     *
     * @required
     */
    public function setEm(EntityManagerInterface $em): void
    {
        $this->em = $em;
    }
}
