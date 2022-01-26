<?php


namespace app\Classes\Structure;

interface InterfacePublicAgent
{
 
    function __construct();
    
    public function load(string $publicAgentCode): void ;

    public function loadCatchedData(string $externalData): object;
    
}