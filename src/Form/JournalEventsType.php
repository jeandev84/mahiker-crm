<?php
namespace App\Form;

use App\Entity\JournalEvents;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JournalEventsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Наименование',
                'attr'  => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание',
                'attr'  => [
                    'class' => 'form-control mb-3',
                    'style' => 'resize: none;'
                ]
            ])
            ->add('startAt', DateType::class, [
                'label' => 'Дата началого',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'yyyy-MM-dd',
                'attr'  => [
                    'class' => 'form-control js-datepicker mb-3'
                ]
            ])
            ->add('endAt', DateType::class, [
                'label' => 'Дата конца',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'yyyy-MM-dd',
                'attr'  => [
                    'class' => 'form-control js-datepicker mb-3'
                ]
            ])
            ->add('owner', EntityType::class, [
                'label' => 'Назначение (пользователь)',
                'class' => User::class,
                'choice_label' => 'fullName',
                'attr'  => [
                    'class' => 'form-control'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JournalEvents::class,
        ]);
    }
}
