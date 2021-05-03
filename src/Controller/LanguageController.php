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
     */
    public function index(String $lang, Request $request, Session $session): Response
    {

        $session->set('_locale', $lang);
        return $this->redirectToRoute('home');
    }
}
