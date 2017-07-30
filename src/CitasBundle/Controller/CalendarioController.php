<?php

namespace CitasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CalendarioController extends Controller {

    /**
     * Lists all cita entities.
     *
     * @Route("/", name="index")
     * @Method("GET")
     */
    public function calendarioAction() {
        $em = $this->getDoctrine()->getManager();
        $calendario = $em->getRepository('CitasBundle:Citas')->findAll();
        return $this->render('CitasBundle:Default:index.html.twig', array(
                    'calendario' => $calendario,
        ));
    }

}
