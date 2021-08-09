<?php


namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Passe;
use App\Exception\Api\InvalidParametersException;
use App\Service\SattelliteCalculation;
use Symfony\Component\HttpFoundation\RequestStack;

class PasseDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
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
     * @throws \App\Predict\PredictException
     */
    public function getCollection(string $resourceClass, string $operationName = null)
   {
       $query = $this->requestStack->getCurrentRequest()->query;

       $lat = (float)$query->get('lat');
       $lon = (float)$query->get('lon');
       $day = (int)$query->get('day', 1);
       $lang = (string)$query->get('lang');
       $this->requestStack->getCurrentRequest()->setLocale($lang);
       if ($day <= 0 || $day > 15){
           throw new InvalidParametersException("Number of day incorrect.");
       }

       $corectPasses = [];
       $passes = $this->sattelliteCalculation->getVisiblePasses($lat, $lon, $day)['passes'];
        foreach ($passes as $day) {
            foreach ($day as $passe) {
                $corectPasses[] = $passe;
            }
        }
       return $corectPasses;
   }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Passe::class;
    }
}