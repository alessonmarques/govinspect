<?php

namespace app\Classes;

use \Goutte\Client;

trait TraitFundamentals {
   
    function verifyPath($path)
    {
        $actualPath = '/';
        if($path[strlen($path) - 1] == '/') 
        {
            $path = substr($path, 0, strlen($path) - 1);
        }

        $exploitedPath =  explode('/', $path);
        array_shift($exploitedPath);
        
        foreach($exploitedPath as $folder)
        {

            $scan = scandir($actualPath);
            array_shift($scan);array_shift($scan);

            $actualPath .= $folder . '/';

            $folder = str_replace('\\', '', $folder);

            if(!in_array($folder, $scan))
            {
                mkdir($actualPath, 0777);
            }
        }
        return $path.'/';
    }

    function getMountedName($name)
    {
        return str_replace([' ', '_', '-'], '-', strtolower($this->removeAccent($name)));
    }
    
    function removeAccent($string){
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
    }

    function trim_array (&$value, $key) {
        $value = trim($value);
    }

    function getData(string $url) {
        $httpClient = new Client();
        $crawler = $httpClient->request('GET', $url);
        return $crawler;
    }

    
}