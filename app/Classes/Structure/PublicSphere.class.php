<?php


namespace app\Classes\Structure;

use app\Classes\TraitFundamentals;

abstract class PublicSphere
{
    use TraitFundamentals;

    private $pathToLocalData;

    protected   $domain;

    public  $type;
    public  $lastUpdate;

    function __construct($type)
    {
        $this->pathToLocalData    = (substr((__DIR__), 0, strpos((__DIR__), '/Support'))) . '/Extras/' . date('Y') . '/data/' . $type . "/";
        $this->verifyPath($this->pathToLocalData);

        $this->type         = $type;
        $this->load();
    }

    function toArray()
    {
        $lastUpdate = $this->lastUpdate;

        $agentsData = compact('lastUpdate');
        return $agentsData;
    }

    function __toString()
    {
        $agentsData = $this->toArray();
        return json_encode($agentsData);
    }

    function load()
    {
        $fileName = $this->pathToLocalData . "{$this->type}.data";
        if (file_exists($fileName)) {
            $loadedData = json_decode(file($fileName)[0]);
            if (isset($loadedData) && !empty($loadedData)) {
                $this->lastUpdate = isset($loadedData->lastUpdate) && !empty($loadedData->lastUpdate) ? $loadedData->lastUpdate : NULL;
            }
        }
    }

    function save()
    {
        $this->lastUpdate = date('Y-m-d H:i:s');
        
        $fileName = $this->pathToLocalData . "{$this->type}.data";
        
        $dataHandle = fopen($fileName, 'wa+');
        fwrite($dataHandle, $this);
        fclose($dataHandle);
    }

}