<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Categorie;

/**
 * Description of CategorieType
 *
 * @author sysadmin
 */
class CategorieType extends AbstractType
{
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
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class
        ]);
    }
}
