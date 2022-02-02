<?php


namespace App\Service;


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
                                RequestStack $requestStack,
                                HttpClientInterface $client,
                                SessionInterface $session
    )
    {
        $this->requestStack = $requestStack;
        $this->client = $client;
        $this->session = $session;
    }


    /**
     * Recupère la latitude , lontitude et cityName dans un array
     * @return array
     * @throws TransportExceptionInterface
     */
    public function getLatLonCity(): array
    {
        $request = $this->requestStack->getCurrentRequest();
        $lat = null;
        $lon = null;
        $cityName = null;

        //On regarde les valeurs en post

        if ($request->isMethod('POST') && !is_null($request->get('lat')) && !is_null($request->get('lon')) && !is_null($request->get('city'))) {
            $lat = $request->get('lat');
            $lon = $request->get('lon');
            $cityName = $request->get('city');

            $this->session->set('lat', $lat);
            $this->session->set('lon', $lon);
            $this->session->set('cityName', $cityName);
            return [
                'lat' => (float) $lat,
                'lon' => (float) $lon,
                'cityName' => $cityName
            ];
        }

        //On regarde les valeurs en GET.
        if (!is_null($request->get('city'))) {
            return $this->callApiCity((string) ($request->get('city')));
        }

        //On regarde les valeurs en session
        if (!is_null($this->session->get('lat')) && !is_null($this->session->get('lon')) && $this->session->get('cityName')) {
            $lat = $this->session->get('lat');
            $lon = $this->session->get('lon');
            $cityName = $this->session->get('cityName');
            return [
                'lat' => (float) $lat,
                'lon' => (float) $lon,
                'cityName' => $cityName
            ];
        }
        return [
            'lat' => (float) 48,
            'lon' => 2.33,
            'cityName' => "Paris"
        ];
    }

    /**
     * Appel d'une api pour récupérer la latitude, lontitude depuis le nom d'une ville.
     * @param string $city
     * @throws TransportExceptionInterface
     */
    #[ArrayShape(['lat' => "mixed", 'lon' => "mixed", 'cityName' => "mixed"])] public function callApiCity(string $city): array
    {
        $response = $this->client->request('GET', "https://nominatim.openstreetmap.org/search?format=json&q=" . $city);

            if ($response->getStatusCode() !== 500 && count($response->toArray()) !== 0) {
                $cityInfo = $response->toArray()[0];
                $lat = $cityInfo['lat'];
                $lon = $cityInfo['lon'];
                $cityName = $cityInfo['display_name'];

                $this->session->set('lat', $lat);
                $this->session->set('lon', $lon);
                $this->session->set('cityName', $cityName);
            }

        return [
            'lat' => (float) $lat,
            'lon' => (float) $lon,
            'cityName' => $cityName
        ];

    }


}