<?php


namespace App\Service;


use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class IpInformation
 * GET information from the IP of the User
 * @package App\Service
 */
class IpInformation
{

    public $ip = null;
    public string $city;
    public string $region;
    public string $country;
    public string $lat;
    public string $lon;
    public string $postal;
    public string $timeZone;

    /**
     * IpInformation constructor.
     * @param RequestStack $requestStack
     * @param ContainerBagInterface $containerBag
     * @param HttpClientInterface $client
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function __construct(RequestStack $requestStack, ContainerBagInterface $containerBag, HttpClientInterface $client)
    {
        if (is_null($this->ip)) {
            $request = $requestStack->getCurrentRequest();
            $ip = $request->getClientIp();
            //TODO remove this part, maybe is unnecessary.
            if ($ip === null && !empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            if ($ip !== "::1" && !str_starts_with($ip, '192.168') && $ip !== "127.0.0.1") {
                //TOTO Test this part
                $apiKey = $containerBag->get('IP_INFORMATION_KEY');
                $urlIp = "http://ipinfo.io/" . $ip . "?token=" . $apiKey;
                $response = $client->request('GET', $urlIp);
                if ($response->getStatusCode() !== 429) {
                    $this->ip = $ip;
                    $ipInfo = $response->toArray();
                    $this->country = $ipInfo['country'];
                    $this->city = $ipInfo['city'];
                    $this->region = $ipInfo['region'];
                    $loc = explode(',', $ipInfo['loc']);
                    $this->lat = $loc[0];
                    $this->lon = $loc[1];
                    $this->postal = $ipInfo['postal'];
                    $this->timeZone = $ipInfo['timezone'];
                }

            }
        }


    }
}