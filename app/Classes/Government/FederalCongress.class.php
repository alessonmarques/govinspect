<?php 

namespace app\Classes\Government;

use \app\Classes\Structure\PublicSphere;
use \app\Classes\Structure\InterfacePublicSphere;

use \app\Classes\Government\Roles\Congressperson;

class FederalCongress extends PublicSphere implements InterfacePublicSphere
{
    const PUBLIC_SPHERE_TYPE = 'FEDERAL';
 
    private $pathToLocalData;

    private $agents;
    private $totalAgents;

    public function __construct()
    {
        $this->domain = "https://www.camara.leg.br/";
        
        parent::__construct($this::PUBLIC_SPHERE_TYPE);
    }

    private function getCurrentLegislatureAgents() {
        $endPoint = "/deputados/quem-sao";
        $url = $this->domain . $endPoint;
        $crawler = $this->getData($url);
        $agents = [];
        $crawler->filter('select#parametro-nome > option')->each(function ($node) use (&$agents) {
            if (!empty($node->attr('value'))) {
                $agents[] = ['code' => $node->attr('value'), 'name' => $node->text()];
            }
        });
        $this->totalAgents = count($agents);
        return $agents;
    }

    private function getAgentInfo(int $agentCode) {
        $agent = new Congressperson();
        $agent->load($agentCode);
        return $agent;
    }

    public function loadAgentsData(): void {
        $agentList = $this->getCurrentLegislatureAgents();
        foreach ($agentList as $agent) {
            $this->agents[] = $this->getAgentInfo($agent['code']);
            sleep(1); // Set the time to sleep to don't get blocked by the target.
        }
        print_r($this->agents); die();
    }
}