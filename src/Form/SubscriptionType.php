<?php

namespace App\Form;

use App\Entity\Subscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubscriptionType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('Suscribirme', SubmitType::class, ['attr' => ['class' => 'btn btn-lg btn-primary btn-block']]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults(['data_class' => Subscription::class,]);
  }
}
