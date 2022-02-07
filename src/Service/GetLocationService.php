<?php


namespace App\Service;


use App\Entity\Location;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class GetLocationService
 * Le service getLocationService permet de récupérer la latitude, longitude
 * @package App\Service
 */
class GetLocationService
{


    /**
     * @var RequestStack
     */
    private RequestStack $requestStack;
    /**
     * @var HttpClientInterface
     */
    private HttpClientInterface $client;
    /**
     * @var SessionInterface
     */
    private SessionInterface $session;

    public function __construct(
        RequestStack        $requestStack,
        HttpClientInterface $client,
        SessionInterface    $session
    )
    {
        $this->requestStack = $requestStack;
        $this->client = $client;
        $this->session = $session;
    }


    /**
     * Recupère la latitude , lontitude et cityName dans un array
     * @return Location
     * @throws TransportExceptionInterface
     */
    public function getLatLonCity(): Location
    {
        $request = $this->requestStack->getCurrentRequest();

        //On regarde les valeurs en post
        if ($request->isMethod('POST') && !is_null($request->get('lat')) && !is_null($request->get('lon')) && !is_null($request->get('city'))) {
            $lat = $request->get('lat');
            $lon = $request->get('lon');
            $cityName = $request->get('city');

            $location = new Location($lat, $lon, $cityName);
            $this->session->set('location', $location);
            return $location;
        }

        //On regarde les valeurs en GET.
        if (!is_null($request->get('city'))) {
            $location = $this->callApiCity((string)($request->get('city')));
            if (!is_null($location)) {
                return $location;
            }
        }

        //On regarde les valeurs en session
        if (!is_null($this->session->get('location'))) {
            return $this->session->get('location');
        }
        return new Location((float)48, 2.33, "Paris");
    }

    /**
     * Appel d'une api pour récupérer la latitude, lontitude depuis le nom d'une ville.
     * @param string $city
     * @throws TransportExceptionInterface
     */
    public function callApiCity(string $city): Location
    {
        $response = $this->client->request('GET', "https://nominatim.openstreetmap.org/search?format=json&q=" . $city);
        $location = null;
        if ($response->getStatusCode() !== 500 && count($response->toArray()) !== 0) {
            $cityInfo = $response->toArray()[0];
            $lat = $cityInfo['lat'];
            $lon = $cityInfo['lon'];
            $cityName = $cityInfo['display_name'];
            $location = new Location($lat, $lon, $cityName);
            $this->session->set('location', $location);
        }
        return $location;


    }


}