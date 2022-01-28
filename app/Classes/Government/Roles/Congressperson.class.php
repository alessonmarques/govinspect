<?php

namespace app\Classes\Government\Roles;

use app\Classes\Structure\PublicAgent;
use app\Classes\Structure\InterfacePublicAgent;

class Congressperson extends PublicAgent implements InterfacePublicAgent
{
    const PUBLIC_SPHERE_TYPE = 'FEDERAL';
    const PUBLIC_AGENT_TYPE = 'CONGRESSPERSON';

    private $code;
    private $name;
    private $email;
    private $telephone;
    private $address;
    private $birthDate;
    private $naturalness;
    
    private $updatedAt;

    function __construct()
    {
        $this->domain = "https://www.camara.leg.br/deputados/";
        parent::__construct($this::PUBLIC_SPHERE_TYPE, $this::PUBLIC_AGENT_TYPE);
    }

    function toArray()
    {
        $code = $this->code;
        $name = $this->name;
        $email = $this->email;
        $telephone = $this->telephone;
        $address = $this->address;
        $birthDate = $this->birthDate;
        $naturalness = $this->naturalness;
        $updatedAt = $this->updatedAt;
        $agentData = compact('code', 'name', 'email', 'telephone', 'address', 'birthDate', 'naturalness', 'updatedAt');
        return $agentData;
    }

    function __toString()
    {
        $agentData = $this->toArray();
        return json_encode($agentData);
    }
    
    function load(string $publicAgentCode): void
    {
        $fileName = $this->pathToLocalData . "{$publicAgentCode}.data";
        if (file_exists($fileName)) {
            $loadedData = json_decode(file($fileName)[0]);
            if (isset($loadedData) && !empty($loadedData)) {
                $this->code = isset($loadedData->code) && !empty($loadedData->code) ? $loadedData->code : NULL;
                $this->name = isset($loadedData->name) && !empty($loadedData->name) ? $loadedData->name : NULL;
                $this->email = isset($loadedData->email) && !empty($loadedData->email) ? $loadedData->email : NULL;
                $this->telephone = isset($loadedData->telephone) && !empty($loadedData->telephone) ? $loadedData->telephone : NULL;
                $this->address = isset($loadedData->address) && !empty($loadedData->address) ? $loadedData->address : NULL;
                $this->birthDate = isset($loadedData->birthDate) && !empty($loadedData->birthDate) ? $loadedData->birthDate : NULL;
                $this->naturalness = isset($loadedData->naturalness) && !empty($loadedData->naturalness) ? $loadedData->naturalness : NULL;
                $this->updatedAt = isset($loadedData->updatedAt) && !empty($loadedData->updatedAt) ? $loadedData->updatedAt : NULL;
            }
        }
        else
        {
            $this->code = $publicAgentCode;
            $this->downloadAgentInfo();
        }
    }

    function loadCatchedData(string $externalData): object
    {
        $mountedName = $this->getMountedName($externalData->nome);
        $this->load($mountedName);
        $this->loadExternalData($externalData);
        return (object) $this->toArray();
    }

    function save()
    {
        $this->updatedAt = date('Y-m-d H:i:s');
        $fileName = $this->pathToLocalData . "{$this->getMountedName($this->code)}.data";
        $dataHandle = fopen($fileName, 'wa+');
        fwrite($dataHandle, $this);
        fclose($dataHandle);
    }

    private function downloadAgentInfo()
    {
        $url = $this->domain . $this->code;
        $crawler = $this->getData($url);
        $crawler->filter('ul.informacoes-deputado > li')->each(function ($node) use (&$agents) {
            $bioInfo = $node->text();
            $bioInfo = explode(':', $bioInfo);

            $key = trim($bioInfo[0]);
            $value = trim($bioInfo[1]);
            
            switch ($key) {
                case "Nome Civil": 
                    $this->name = $value;
                  break;
                case "E-mail": 
                    $this->email = $value;
                  break;
                case "Telefone": 
                    $this->telephone = $value;
                  break;
                case "Endereço": 
                    $this->address = $value;
                  break;
                case "Data de Nascimento": 
                    $this->birthDate = $value;
                  break;
                case "Naturalidade": 
                    $this->naturalness = $value;
                  break;
            }
        });
        $this->save();
    }

}