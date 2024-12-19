<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use \App\Entity\Playlist;
use App\Entity\Formation;

/**
 * Classe réprésentant le formulaire associé à l'entité Playlist
 *
 * @author sysadmin
 */
class PlaylistType extends AbstractType
{
    /**
     *
     * @param FormBuilderInterface $formBuilder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options) : void
    {
        $formations = $options['formations'];
        if(count($formations) > 0) {
            $formBuilder
                    ->add('name', TextType::class, [
                        'required' => true,
                        'label' => 'Nom de la playlist'
                    ])
                    ->add('description', TextareaType::class, [
                        'required' => false,
                        'label' => "Description",
                        'attr' => array('rows' => '15')
                    ])
                    ->add('formations', ChoiceType::class, [
                        'label' => 'Formations dans cette playlist',
                        'choices' => $formations,
                        'choice_label' => 'title',
                        'disabled' => true,
                        'expanded' => true,
                        'required' => false,
                        'multiple' => false,
                        'choice_attr' => [
                            'checked' => true
                        ]
                    ])
                    /*->add('formations', EntityType::class, [
                        'class' => Formation::class,
                        'choice_label' => 'title',
                        'data' => $formations,
                        'multiple' => true,
                        'required' => false,
                        'disabled' => true
                    ])*/
                    ->add('submit', SubmitType::class, [
                        'label' => 'Valider'
                    ]);
        } else {
            $formBuilder
                    ->add('name', TextType::class, [
                        'required' => true,
                        'label' => 'Nom de la playlist'
                    ])
                    ->add('description', TextType::class, [
                        'required' => false,
                        'label' => "Description"
                    ])
                    ->add('submit', SubmitType::class, [
                        'label' => 'Valider'
                    ]);
        }
    }
    /**
     *
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Playlist::class,
            'formations' => Formation::class
        ]);
    }
}
