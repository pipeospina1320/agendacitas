<?php

namespace ContabilidadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ComprobanteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombreComprobante')
                ->add('prefijoComprobante')
                ->add('ultimoConsecutivo')
                ->add('descripcion')
                ->add('consecutivoUnico')
                ->add('claseComprobanteRel', EntityType::class, array(
                    'class' => 'ContabilidadBundle:ClaseComprobante',
                    'choice_label' => 'nombreClaseComprobante'
                ))
                ->add('tipoComprobanteRel', EntityType::class, array(
                    'class' => 'ContabilidadBundle:TipoComprobante',
                    'choice_label' => 'nombreTipoComprobante'
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ContabilidadBundle\Entity\Comprobante'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contabilidadbundle_comprobante';
    }


}
