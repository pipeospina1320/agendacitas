<?php

namespace FacturacionBundle\Form;

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

class FacturaType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                
                ->add('comprobanteRel', EntityType::class, array(
                    'class' => 'GeneralBundle:Comprobante',
                    'choice_label' => 'nombreComprobante',
                    'required' => true))
                
                ->add('centroCostoRel', EntityType::class, array(
                    'class' =>'GeneralBundle:CentroCosto',
                    'choice_label' => 'nombreCentroCosto',
                    'required' => true))
                
                ->add('formaPagoRel', EntityType::class, array(
                    'class' =>'GeneralBundle:FormaPago',
                    'choice_label' => 'nombreFormaPago',
                    'required' => true))

                ->add('codigoVendedorFk', TextType::class, array('required' => true))
                
                ->add('fechaMovimiento', DateType::class, array('widget' => 'single_text', 'format' => 'yyyy-MM-dd', 'attr' => array('class' => 'date',)))
                
               
                
               
                ;
    }
 public function getBlockPrefix() {
        return 'form';
    }

}
