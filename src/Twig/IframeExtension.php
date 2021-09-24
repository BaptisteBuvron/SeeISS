<?php


namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Twig Filter, to convert a youtube url to an embed youtube url.
 */
class IframeExtension extends AbstractExtension
{

    public function getFilters(): array
    {
        return [
            new TwigFilter('iframe', [$this, 'createIframe']),
        ];
    }

    public function createIframe($url): string
    {
        $parsedUrl = parse_url($url);
        # extract query string
        parse_str(@$parsedUrl['query'], $queryString);
        $youtubeId = @$queryString['v'] ?? substr(@$parsedUrl['path'], 1);
        return "https://youtube.com/embed/{$youtubeId}";
    }
}

