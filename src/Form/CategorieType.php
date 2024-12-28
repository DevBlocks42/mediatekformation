<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Categorie;

/**
 * Classe représentant le formulaire associé à l'entité Categorie
 *
 * @author sysadmin
 */
class CategorieType extends AbstractType
{
    /**
     *
     * @param FormBuilderInterface $formBuilder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options) : void
    {
        $formBuilder
                ->add('name', TextType::class, [
                    'label' => 'Nom'
                ])
                ->add('submit', SubmitType::class, [
                    'label' => 'Ajouter'
                ]);
    }
    /**
     *
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class
        ]);
    }
}
