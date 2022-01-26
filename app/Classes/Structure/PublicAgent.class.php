<?php


namespace app\Classes\Structure;

use app\Classes\TraitFundamentals;

abstract class PublicAgent
{
    use TraitFundamentals;
    
    protected  $pathToLocalData;

    function __construct(string $sphereType, string $agentType)
    {
        $this->pathToLocalData = (substr((__DIR__), 0, strpos((__DIR__), '/Support'))) . '\/Extras/' . date('Y') . '\/data/' . $type . "\/Agents/" . $agentType . "/";
        $this->verifyPath($this->pathToLocalData);
    }

    function toArray()
    {
        $name = $this->name;
        $updatedAt = $this->updatedAt;

        $agentData = compact('updatedAt');
        return $agentData;
    }

    function __toString()
    {
        $agentData = $this->toArray();
        return json_encode($agentData);
    }
}