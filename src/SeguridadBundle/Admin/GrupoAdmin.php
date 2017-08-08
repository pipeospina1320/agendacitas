<?php

namespace SeguridadBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class GrupoAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper->add('nombre', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper->add('nombre');
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper->addIdentifier('codigoGrupoPk')
                ->add('nombre');
    }

    public function toString($object) {
        return $object instanceof BlogPost ? $object->getTitle() : $object->getNombre();
    }

}
