<?php

namespace SeguridadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SeguridadController extends Controller {

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request) {


        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('SeguridadBundle:Seguridad:login.html.twig', array(
                    'last_username' => $lastUsername,
                    'error' => $error,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request) {
        
    }

    public function registroAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $arrControles = $request->request->All();
            $arUsuario = new SeguridadBundle\Entity\User();
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($arUsuario);
            $password = $encoder->encodePassword($arrControles['TxtPassword'], $arUsuario->getSalt());
            $arUsuario->setPassword($password);
            $arUsuario->setUsername($arrControles['TxtUsuario']);
            $arUsuario->setNombreCorto($arrControles['TxtNombreCorto']);
            $arUsuario->setEmail($arrControles['TxtUsuario']);
            $em->persist($arUsuario);
            $em->flush();
            return $this->redirect($this->generateUrl('login'));
        }
        return $this->render('SeguridadBundle:Seguridad:registro.html.twig');
    }

}
