<?php

namespace App\Form;

use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface as FormFormBuilderInterface;

class AddBookForm extends AbstractType
{
  public function buildForm(FormFormBuilderInterface $builder, array $options): void
  {
    $criteria = $options['empty_data'];
    $builder
        ->add('title', StringType::class, [
            'required' => true,
            'empty_data' => $criteria->title,
            'label'=>'Titre du livre'
        ])
        ->add('author', TextType::class, [
            'required' => true,
            'empty_data' => $criteria->author,
            'label'=>'author',
        ])
        ->add('date_edition', DateType::class, [
            'required' => true,
            'empty_data' => $criteria->date_edition,
            'label'=>'date_edition',
        ])
        ->add('date_add', DateType::class, [
          'required' => true,
          'empty_data' => $criteria->date_add,
          'label'=>'date_add',
      ])
      ->add('date_update', DateType::class, [
        'required' => false,
        'empty_data' => $criteria->date_update,
        'label'=>'date_update',
    ])
        ->add('submit', SubmitType::class, [
            'label' => 'Créer',
        ]);
  }
}