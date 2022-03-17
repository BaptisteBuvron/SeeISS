<?php


namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\PasseDisplay;
use App\Entity\Passe;
use App\Entity\SatLocalisation;
use App\Exception\Api\InvalidParametersException;
use App\Predict\PredictException;
use App\Service\SattelliteCalculation;
use Symfony\Component\HttpFoundation\RequestStack;

class SatLocalisationProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{

    private SattelliteCalculation $sattelliteCalculation;
    private RequestStack $requestStack;

    public function __construct(SattelliteCalculation $sattelliteCalculation, RequestStack $requestStack)
    {
        $this->sattelliteCalculation = $sattelliteCalculation;
        $this->requestStack = $requestStack;
    }

    /**
     * @throws InvalidParametersException
     * @throws PredictException
     */
    public function getCollection(string $resourceClass, string $operationName = null): array
    {

        $query = $this->requestStack->getCurrentRequest()->query;
        $lat = (float)$query->get('lat');
        $lon = (float)$query->get('lon');
        return $this->sattelliteCalculation->realTimeAPI($lat, $lon);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === SatLocalisation::class;
    }
}