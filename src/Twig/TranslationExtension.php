<?php

namespace App\Twig;

use App\Service\FreeTranslationService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TranslationExtension extends AbstractExtension
{
    private FreeTranslationService $translationService;

    public function __construct(FreeTranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('translate_db', [$this, 'translateDbContent']),
        ];
    }

    public function translateDbContent(?string $text, string $locale = 'fr'): string
    {
        if (empty($text)) {
            return '';
        }

        // Only translate if the target locale is French ('fr')
        if ($locale === 'fr') {
            return $this->translationService->translate($text, 'fr', 'en');
        }

        return $text;
    }
}
