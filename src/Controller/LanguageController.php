<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends AbstractController
{
    /**
     * @Route("/lang/{lang}", name="language_selector")
     * @param String $lang
     * @param Request $request
     * @param Session $session
     * @return Response
     */
    public function index(String $lang, Request $request ,Session $session): Response
    {
        $session->set('_locale', $lang);

        #If lastUrl is set
       if ($request->query->has('lastUrl')) {
            $lastUrl = $request->query->get('lastUrl');
           return $this->redirect($lastUrl);
       }

        return $this->redirectToRoute('home');
    }
}
