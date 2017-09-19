<?php

namespace GeneralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CierrePeriodoType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
//        $builder->add('nombreComprobante')
//                ->add('prefijoComprobante')
//                ->add('ultimoConsecutivo')
//                ->add('afectaInventario', CheckboxType::class, array('required' => false))
//                ->add('suma', CheckboxType::class, array('required' => false))
//                ->add('resta', CheckboxType::class, array('required' => false))
//                ->add('descripcion')
//                ->add('consecutivoUnico')
//                ->add('claseComprobanteRel', EntityType::class, array(
//                    'class' => 'GeneralBundle:ClaseComprobante',
//                    'choice_label' => 'nombreClaseComprobante'
//                ))
//                ->add('valorSugeridoRel', EntityType::class, array(
//                    'class' => 'GeneralBundle:ValorSugerido',
//                    'choice_label' => 'nombreValorSugerido'
//                ))
//                ->add('tipoComprobanteRel', EntityType::class, array(
//                    'class' => 'GeneralBundle:TipoComprobante',
//                    'choice_label' => 'nombreTipoComprobante'
//        ));
    }

    public function getBlockPrefix() {
        return 'form';
    }

}
