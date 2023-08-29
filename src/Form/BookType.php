<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
      $builder
      ->add('title',TextType::class,[
          'required' => true,
      ])
      ->add('author',TextType::class,[
        'required' => true,
      ])  
      ->add('date_edition',DateType::class,[
        'required' => true,
      ])
      ->add('submit', SubmitType::class, [
          'label' => 'Ajout Livre',
      ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => [
                // désactivation validation HTML5
                'novalidate' => 'novalidate',
            ]
        ]);
    }
}