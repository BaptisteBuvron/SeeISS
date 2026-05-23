<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Exception\Api\InvalidParametersException;
use App\Service\SattelliteCalculation;
use Symfony\Component\HttpFoundation\RequestStack;

class PasseProvider implements ProviderInterface
{
    private SattelliteCalculation $sattelliteCalculation;
    private RequestStack $requestStack;

    public function __construct(SattelliteCalculation $sattelliteCalculation, RequestStack $requestStack)
    {
        $this->sattelliteCalculation = $sattelliteCalculation;
        $this->requestStack = $requestStack;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $query = $this->requestStack->getCurrentRequest()->query;

        $lat = (float)$query->get('lat');
        $lon = (float)$query->get('lon');
        $day = (int)$query->get('day', 1);
        $lang = (string)$query->get('lang');

        if ($lang) {
            $this->requestStack->getCurrentRequest()->setLocale($lang);
        }

        if ($day <= 0 || $day > 15) {
            throw new InvalidParametersException("Number of day incorrect.");
        }

        $corectPasses = [];
        $passes = $this->sattelliteCalculation->getVisiblePasses($lat, $lon, $day)['passes'];
        foreach ($passes as $dayPasses) {
            foreach ($dayPasses as $passe) {
                $corectPasses[] = $passe;
            }
        }
        return $corectPasses;
    }
}
