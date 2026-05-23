<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class FreeTranslationService
{
    private HttpClientInterface $client;
    private CacheInterface $cache;

    public function __construct(HttpClientInterface $client, CacheInterface $cache)
    {
        $this->client = $client;
        $this->cache = $cache;
    }

    public function translate(?string $text, string $targetLang = 'fr', string $sourceLang = 'en'): string
    {
        if (empty($text) || empty(trim($text))) {
            return $text ?? '';
        }

        // Generate cache key from MD5 hash of text and target language
        $cacheKey = 'tr_' . md5($text . '_' . $targetLang);

        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($text, $targetLang, $sourceLang) {
            // Cache indefinitely (e.g., 6 months)
            $item->expiresAfter(3600 * 24 * 180);

            try {
                // Request to Google Translate free endpoint
                $response = $this->client->request('GET', 'https://translate.googleapis.com/translate_a/single', [
                    'query' => [
                        'client' => 'gtx',
                        'sl' => $sourceLang,
                        'tl' => $targetLang,
                        'dt' => 't',
                        'q' => $text,
                    ],
                ]);

                if ($response->getStatusCode() === 200) {
                    $data = $response->toArray();
                    $translatedParts = [];
                    if (isset($data[0]) && is_array($data[0])) {
                        foreach ($data[0] as $part) {
                            if (isset($part[0])) {
                                $translatedParts[] = $part[0];
                            }
                        }
                    }
                    if (!empty($translatedParts)) {
                        return implode('', $translatedParts);
                    }
                }
            } catch (\Exception $e) {
                // Return original text if HTTP request or parsing fails
            }

            return $text;
        });
    }
}
