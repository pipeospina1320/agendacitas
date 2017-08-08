<?php

namespace InventarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class ArticuloType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
               
                ->add('codigoArticulo', TextType::class, array('required' => true))
                ->add('manejaKardex', CheckboxType::class, array('required' => true))
                ->add('estadoActivo', CheckboxType::class, array('required' => true))
                ->add('codigoBarras', TextType::class, array('required' => true))
                ->add('nombreArticulo', TextType::class, array('required' => true))
                ->add('descripcionArticulo', TextType::class, array('required' => true))
                ->add('marcaArticuloRel', EntityType::class, array(
                    'class' => 'InventarioBundle:MarcaArticulo',
                    'choice_label' => 'nombreMarcaArticulo'))
                
                ->add('grupoArticuloRel', EntityType::class, array(
                    'class' => 'InventarioBundle:GrupoArticulo',
                    'choice_label' =>'nombreGrupoArticulo'))
                
                ->add('unidadManejoRel', EntityType::class, array(
                    'class' => 'InventarioBundle:UnidadManejo',
                    'choice_label' => 'nombreUnidadManejo'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'InventarioBundle\Entity\Articulo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'inventariobundle_articulo';
    }

}
