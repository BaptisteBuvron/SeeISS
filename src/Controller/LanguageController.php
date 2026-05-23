<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LanguageController extends AbstractController
{
    #[Route('/lang/{lang}', name: 'language_selector')]
    public function index(string $lang, Request $request): Response
    {
        $request->getSession()->set('_locale', $lang);

        #If lastUrl is set
        if ($request->query->has('lastUrl')) {
            $lastUrl = $request->query->get('lastUrl');
            return $this->redirect($lastUrl);
        }

        return $this->redirectToRoute('home');
    }
}
