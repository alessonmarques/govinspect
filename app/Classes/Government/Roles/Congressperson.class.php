<?php

namespace app\Classes\Government\Roles;

use app\Classes\Structure\PublicAgent;
use app\Classes\Structure\InterfacePublicAgent;

class Congressperson extends PublicAgent implements InterfacePublicAgent
{
    const PUBLIC_SPHERE_TYPE = 'FEDERAL';
    const PUBLIC_AGENT_TYPE = 'CONGRESSPERSON';
 
    protected $newAgent;  

    private $name;
    private $code;
    
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
        
        $updatedAt = $this->updatedAt;

        $agentData = compact('code', 'name', 'updatedAt');
        return $agentData;
    }

    function __toString()
    {
        $agentData       = $this->toArray();
        return json_encode($agentData);
    }
    
    function load(string $publicAgentCode): void
    {
        $fileName = $this->pathToLocalData . "{$publicAgentCode}.data";

        if (file_exists($fileName)) {
            $loadedData = json_decode(file($fileName)[0]);
            if (isset($loadedData) && !empty($loadedData)) {
                $this->code = isset($loadedData->code) && !empty($loadedData->code) ? $loadedData->code : null;
                $this->name = isset($loadedData->name) && !empty($loadedData->name) ? $loadedData->name : null;
                
                $this->updatedAt = isset($loadedData->updatedAt) && !empty($loadedData->updatedAt) ? $loadedData->updatedAt : null;
            }
        }
        else
        {
            $this->code = $publicAgentCode;
            $this->newAgent = true;
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

    private function loadExternalData($externalData)
    { 
        $this->save();
    }
    
}