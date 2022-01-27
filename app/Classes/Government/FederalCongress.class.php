<?php 

namespace app\Classes\Government;

use \app\Classes\Structure\PublicSphere;
use \app\Classes\Structure\InterfacePublicSphere;
use \Symfony\Component\DomCrawler\Crawler;
use \GuzzleHttp\Client;

class FederalCongress extends PublicSphere implements InterfacePublicSphere
{
    const PUBLIC_SPHERE_TYPE = 'FEDERAL';
 
    private $pathToLocalData;

    private $totalAgents;

    public function __construct()
    {
        $this->domain = "https://www.camara.leg.br/";
        
        parent::__construct($this::PUBLIC_SPHERE_TYPE);
    }

    protected function getData(string $url) {
        $httpClient = new \Goutte\Client();
        $crawler = $httpClient->request('GET', $url);
        return $crawler;
    }

    private function getCurrentLegislatureAgents() {
        $endPoint = "/deputados/quem-sao";
        $url = $this->domain . $endPoint;
        $crawler = $this->getData($url);
        $agents = [];
        $crawler->filter('select#parametro-nome > option')->each(function ($node) use (&$agents) {
            $agents[] = ['id' => $node->attr('value'), 'name' => $node->text()];
        });
        $this->totalAgents = count($agents);
        return $agents;
    }

    public function downloadAgentsData(): void {
        $agentList = $this->getCurrentLegislatureAgents();
        print_r($list); die();
    }
}