<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Formation;

/**
 * Description of FormationType
 *
 * @author sysadmin
 */
class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $formBuilder, array $options) : void
    {
        $categories = $options['categories'];
        $playlist = $options['playlist'];
        $formBuilder
                ->add("publishedAt", DateType::class, [
                    'label' => 'Date'
                ])
                ->add("title", TextType::class, [
                    'label' => 'Titre'
                ])
                ->add("description", TextType::class, [
                    'required' => false,
                    'label' => 'Description'
                ])
                ->add("categories", EntityType::class, [
                    'class' => \App\Entity\Categorie::class,
                    'choice_label' => 'name',
                    'data' => $categories,
                    'multiple' => true,
                    'required' => false
                ])
                ->add("playlist", EntityType::class, [
                    'class' => \App\Entity\Playlist::class,
                    'choice_label' => 'name',
                    'data' => $playlist,
                    'multiple' => false,
                    'required' => true
                ])
                ->add("submit", SubmitType::class, [
                    'label' => "Valider"
                ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
            'categories' => \App\Entity\Categorie::class,
            'playlist' => \App\Entity\Playlist::class
        ]);
    }
}
