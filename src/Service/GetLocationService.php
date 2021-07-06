<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class GetLocationService
 * Le service getLocationService permet de récupérer la latitude, longitude
 * @package App\Service
 */
class GetLocationService
{

    /**
     * @var IpInformation
     */
    private IpInformation $ipInformation;
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

    public function __construct(IpInformation $ipInformation,
                                RequestStack $requestStack,
                                HttpClientInterface $client,
                                SessionInterface $session
    )
    {
        $this->ipInformation = $ipInformation;
        $this->requestStack = $requestStack;
        $this->client = $client;
        $this->session = $session;
    }


    /**
     * Recupère la latitude , lontitude et cityName dans un array
     * @return array
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
        } //On regarde les valeurs en GET.
        else if (!is_null($request->get('city'))) {
            $this->callApiCity(strval($request->get('city')));
            $lat = $this->session->get('lat');
            $lon = $this->session->get('lon');
            $cityName = $this->session->get('cityName');
        } //On regarde les valeurs en session
        else if (!is_null($this->session->get('lat')) && !is_null($this->session->get('lon')) && $this->session->get('cityName')) {
            $lat = $this->session->get('lat');
            $lon = $this->session->get('lon');
            $cityName = $this->session->get('cityName');
        } //On regarde la latitude correspondant à l'addresse ip
        else if (isset($ipInformation->ip)) {
            $lat = $this->ipInformation->lat;
            $lon = $this->ipInformation->lon;
            $cityName = $this->ipInformation->city . '-' . $this->ipInformation->region;
            $this->session->set('lat', $lat);
            $this->session->set('lon', $lon);
            $this->session->set('cityName', $cityName);
        }
        else{
            $lat = 48;
            $lon = 2.33;
            $cityName = "Paris";
        }

        return [
            'lat' => $lat,
            'lon' => $lon,
            'cityName' => $cityName
        ];
    }

    /**
     * Appel d'une api pour récupérer la latitude, lontitude depuis le nom d'une ville.
     * @param string $city
     */
    public function callApiCity(string $city)
    {
        $response = $this->client->request('GET', "https://nominatim.openstreetmap.org/search?format=json&q=" . $city);
        if ($response->getStatusCode() != 500 && sizeof($response->toArray()) != 0) {
            $cityInfo = $response->toArray()[0];
            $lat = $cityInfo['lat'];
            $lon = $cityInfo['lon'];
            $cityName = $cityInfo['display_name'];
            $this->session->set('lat', $lat);
            $this->session->set('lon', $lon);
            $this->session->set('cityName', $cityName);
        }

    }


}