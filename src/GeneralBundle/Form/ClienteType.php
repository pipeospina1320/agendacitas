<?php

namespace GeneralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClienteType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('codigoTipoDocumentoFk', NumberType::class, array('required' => true))
                ->add('numDocumento', NumberType::class, array('required' => true))
                ->add('primerNombre', TextType::class, array('required' => true))
                ->add('segundoNombre', TextType::class, array('required' => true))
                ->add('primerApellido', TextType::class, array('required' => true))
                ->add('segundoApellido', TextType::class, array('required' => true))
                ->add('telefono', TextType::class, array('required' => true))
                ->add('celular', TextType::class, array('required' => true))
                ->add('direccion', TextType::class, array('required' => true));
    }



    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'form';
    }

}
