<?php

namespace App\Service;

use App\Entity\Agency;
use App\Entity\Astronaut;
use App\Entity\Docking;
use App\Entity\Launch;
use App\Entity\Launcher;
use App\Entity\SpaceCraft;
use App\Entity\SpaceCraftConfig;
use App\Entity\SpaceStation;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UpdateDatabaseService
{

    /**
     * @var HttpClientInterface
     */
    private $client;
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @var SpaceStation
     */
    private $spaceStation;

    public function __construct(HttpClientInterface $client, EntityManagerInterface $manager)
    {
        $this->client = $client;
        $this->manager = $manager;
    }

    public function updateDatabaseISS()
    {

        $data = $this->requestTo('https://ll.thespacedevs.com/2.2.0/spacestation/4/?format=json');

        $this->setSpaceStation($data);

        //Astronauts
        if (isset($data["active_expeditions"]) && count($data["active_expeditions"]) > 0) {
            foreach ($data["active_expeditions"] as $expedition) {
                $this->setAstronauts($expedition["crew"]);
            }
        }

    }

    public function setAstronauts(array $astronauts)
    {
        foreach ($astronauts as $astronaut) {
            $this->setAstronaut($astronaut["astronaut"]);
        }
    }

    public function setAstronaut($astronautData,string $role = null): Astronaut
    {


        $astronautRepository = $this->manager->getRepository(Astronaut::class);
        $astronaut = $astronautRepository->findOneBy(array('idApi' => $astronautData["id"]));
        $agency = $this->setAgency($astronautData["agency"]);
        if (is_null($astronaut)) {
            $astronautData = $this->requestTo($astronautData["url"]);
            $astronaut = new Astronaut();
            $astronaut->setIdApi($astronautData["id"])
                ->setUrl($astronautData["url"])
                ->setName($astronautData["name"])
                ->setStatus($astronautData["status"]["name"]);
            if (is_null($astronautData["date_of_death"])) {
                $astronaut->setDateOfDeath(null);
            } else {
                $astronaut->setDateOfDeath(new \DateTime($astronautData["date_of_death"]));
            }
            $astronaut->setDateOfBirth(new \DateTime($astronautData["date_of_birth"]))
                ->setNationality($astronautData["nationality"])
                ->setTwitter($astronautData["twitter"])
                ->setInstagram($astronautData["instagram"])
                ->setBio($astronautData["bio"])
                ->setProfileImg($astronautData["profile_image"])
                ->setProfileImageThumbnail($astronautData["profile_image_thumbnail"])
                ->setWiki($astronautData["wiki"]);
        }
		if (!is_null($role)){
			$astronaut->setRole($role);
		}
        $astronaut->setAgency($agency);
        $this->manager->persist($astronaut);
        $this->manager->flush();
        return $astronaut;
    }

    public function setSpaceStation(array $spaceStationData)
    {
        $spaceStationRepo = $this->manager->getRepository(SpaceStation::class);
        $spaceStation = $spaceStationRepo->findOneBy(array('idApi' => $spaceStationData["id"]));
        if (is_null($spaceStation)) {
            $spaceStation = new SpaceStation();
            $spaceStation->setIdApi($spaceStationData["id"])
                ->setName($spaceStationData["name"])
                ->setUrl($spaceStationData["url"])
                ->setStatus($spaceStationData["status"]["name"])
                ->setType($spaceStationData["type"]["name"])
                ->setFounded(new \DateTime($spaceStationData["founded"]))
                ->setHeight($spaceStationData["height"])
                ->setWidth($spaceStationData["width"])
                ->setMass($spaceStationData["mass"])
                ->setVolume($spaceStationData["volume"])
                ->setDescription($spaceStationData["description"])
                ->setOrbit($spaceStationData["orbit"])
                ->setOnboardCrew($spaceStationData["onboard_crew"])
                ->setImageUrl($spaceStationData["image_url"]);
        }
		$this->spaceStation = $spaceStation;
		

        foreach ($spaceStationData["owners"] as $agency) {
            $spaceStation->addOwner($this->setAgency($agency));
        }
		
		$this->manager->persist($spaceStation);
        $this->manager->flush();

        foreach ($spaceStationData["docking_location"] as $dock){
            $this->setDock($dock);
        }

        foreach ($spaceStationData["active_expeditions"] as $expedition){
            foreach ($expedition["crew"] as $crew){
                $spaceStation->addCrew($this->setAstronaut($crew["astronaut"], $crew["role"]["role"]));

            }
        }
        $this->manager->persist($spaceStation);
        $this->manager->flush();

    }

    public function setAgency(array $agencyData): Agency
    {
        $agencyRepo = $this->manager->getRepository(Agency::class);
        $agency = $agencyRepo->findOneBy(array('idApi' => $agencyData["id"]));
        if (is_null($agency)) {
            $agencyData = $this->requestTo($agencyData["url"]);
            $agency = new Agency();
            $agency->setUrl($agencyData["url"])
                ->setIdApi($agencyData["id"])
                ->setName($agencyData["name"])
                ->setType($agencyData["type"])
                ->setCountryCode($agencyData["country_code"])
                ->setAbbrev($agencyData["abbrev"])
                ->setDescription($agencyData["description"])
                ->setAdministrator($agencyData["administrator"])
                ->setFoundingYear($agencyData["founding_year"])
                ->setInfoUrl($agencyData["info_url"])
                ->setWikiUrl($agencyData["wiki_url"])
                ->setLogoUrl($agencyData["logo_url"])
                ->setImageUrl($agencyData["image_url"]);
            $this->manager->persist($agency);
            $this->manager->flush();
        }
        return $agency;


    }

    public function setDock(array $dock)
    {
        if (!is_null($dock["docked"])) {
            $dockingObject = $this->manager->getRepository(Docking::class)->findOneBy(array('idApi' => $dock["docked"]["id"]));
            if (is_null($dockingObject)) {
                $dockingObject = new Docking();
            }
            $dockingObject->setIdApi($dock["docked"]["id"])
                ->setName($dock["name"]);
            $dock = $dock["docked"];
            $dockingObject->setDocking(new \DateTime($dock["docking"]))
                            ->setUrl($dock["url"]);
            $dockingObject->setSpaceCraft($this->setSpaceCraft($dock["flight_vehicle"]))
                ->setSpaceStation($this->spaceStation);
            $this->manager->persist($dockingObject);
            $this->manager->flush();
        }

    }

    public function setSpaceCraft(array $flightVehicule)
    {
        $spaceCraftData = $flightVehicule["spacecraft"];
        $spaceCraftRepo = $this->manager->getRepository(SpaceCraft::class);
        $spaceCraft = $spaceCraftRepo->findOneBy(array('idApi' => $spaceCraftData['id']));
        if (is_null($spaceCraft)) {
            $spaceCraft = new SpaceCraft();
            $spaceCraft->setIdApi($spaceCraftData['id'])
                ->setUrl($spaceCraftData["url"])
                ->setName($spaceCraftData["name"])
                ->setStatus($spaceCraftData["status"]["name"])
                ->setDescription($spaceCraftData["description"])
                ->setSpaceCraftConfig($this->setSpaceCraftConfig($spaceCraftData["spacecraft_config"]))
                ->setLaunch($this->setLaunch($flightVehicule["launch"]));
        }
        return $spaceCraft;
    }

    public function setLaunch(array $launchData): Launch
    {
        $launchRepo = $this->manager->getRepository(Launch::class);
        $lauch = $launchRepo->findOneBy(array('idApi' => $launchData['id']));
        if (is_null($lauch)){
            $launchData = $this->requestTo($launchData["url"]);
            $lauch = new Launch();
            $lauch->setIdApi($launchData["id"])
                ->setName($launchData["name"])
                ->setUrl($launchData["url"])
                ->setSlug($launchData["slug"])
                ->setStatus($launchData["status"]["name"])
                ->setWindowStart(new \DateTime($launchData["window_start"]))
                ->setWindowEnd(new \DateTime($launchData["window_end"]))
                ->setLaunchServiceProvider($this->setAgency($launchData["launch_service_provider"]))
                ->setLauncher($this->setLauncher($launchData["rocket"]["configuration"]))
                ->setImage($launchData["image"])
                ->setInfographic($launchData["infographic"]);
            if (count($launchData["vidURLs"]) > 0){
                $lauch->setVideo($this->setVideo($launchData["vidURLs"][0]));
            }
            foreach ($launchData["rocket"]["spacecraft_stage"]["launch_crew"] as $crew){
                $lauch->addLaunchCrew($this->setAstronaut($crew["astronaut"]));
            }
            $this->manager->persist($lauch);
            $this->manager->flush();
        }
        return $lauch;
    }

    public function setVideo(array $videoData):Video
    {
        $videoRepo = $this->manager->getRepository(Video::class);
        $video = $videoRepo->findOneBy(array('url' => $videoData['url']));
        if (is_null($video)){
            $video = new Video();
            $video->setUrl($videoData["url"])
                ->setFeatureImage($videoData["feature_image"])
                ->setDescription($videoData["description"])
                ->setTitle($videoData["title"]);
            $this->manager->persist($video);
            $this->manager->flush();
        }
        return $video;
    }

    public function setLauncher(array $launcherData):Launcher
    {
        $launcherRepo = $this->manager->getRepository(Launcher::class);
        $launcher = $launcherRepo->findOneBy(array('idApi' => $launcherData['id']));
        if (is_null($launcher)){
            //$launcherData = $this->requestTo($launcherData["url"]);
            $launcher = new Launcher();
            $launcher->setIdApi($launcherData["id"])
                    ->setUrl($launcherData["url"])
                    ->setName($launcherData["name"])
                    ->setDescription($launcherData["description"])
                    ->setFamily($launcherData["family"])
                    ->setFullName($launcherData["full_name"])
                    ->setManufacturer($this->setAgency($launcherData["manufacturer"]))
                    ->setMinStage($launcherData["min_stage"])
                    ->setMaxStage($launcherData["max_stage"])
                    ->setLength($launcherData["length"])
                    ->setDiameter($launcherData["diameter"])
                    ->setImageUrl($launcherData["image_url"])
                    ->setInfoUrl($launcherData["info_url"])
                    ->setWikiUrl($launcherData["wiki_url"])
                    ->setTotalLaunchCount($launcherData["total_launch_count"])
                    ->setConsecutiveSuccessfulLaunches($launcherData["consecutive_successful_launches"])
                    ->setFailedLaunch($launcherData["failed_launches"])
                    ->setSuccessfulLaunches($launcherData["successful_launches"]);
            $this->manager->persist($launcher);
            $this->manager->flush();
        }
        return $launcher;
    }

    public function setSpaceCraftConfig(array $spaceCraftConfigData): SpaceCraftConfig
    {
        $spaceCraftConfigRepo = $this->manager->getRepository(SpaceCraftConfig::class);
        $spaceCraftConfig = $spaceCraftConfigRepo->findOneBy(array('idApi' => $spaceCraftConfigData['id']));
        if (is_null($spaceCraftConfig)) {
            $spaceCraftConfig = new SpaceCraftConfig();
            $spaceCraftConfig->setIdApi($spaceCraftConfigData["id"])
                ->setUrl($spaceCraftConfigData["url"])
                ->setName($spaceCraftConfigData["name"])
                ->setAgency($this->setAgency($spaceCraftConfigData["agency"]))
                ->setCapability($spaceCraftConfigData["capability"])
                ->setHistory($spaceCraftConfigData["history"])
                ->setDetails($spaceCraftConfigData["details"])
                ->setHeight($spaceCraftConfigData["height"])
                ->setDiameter($spaceCraftConfigData["diameter"])
                ->setCrewCapacity($spaceCraftConfigData["crew_capacity"])
                ->setPalLoadCapacity($spaceCraftConfigData["payload_capacity"])
                ->setImageUrl($spaceCraftConfigData["image_url"])
                ->setWikiLink($spaceCraftConfigData["wiki_link"])
                ->setInfoLink($spaceCraftConfigData["info_link"]);
            $this->manager->persist($spaceCraftConfig);
            $this->manager->flush();
        }
        return $spaceCraftConfig;

    }

    public function requestTo(string $url): array
    {
        $request = $this->client->request('GET', $url);
        if ($request->getStatusCode() == 429) {
            ini_set('max_execution_time', 920);
            sleep(900);
            return $this->requestTo($url);
        }
        return $request->toArray();
    }


}