<?php 

namespace app\Classes\Government;

use \app\Classes\Structure\PublicSphere;
use \app\Classes\Structure\InterfacePublicSphere;

class FederalCongress extends PublicSphere implements InterfacePublicSphere
{
    const PUBLIC_SPHERE_TYPE = 'FEDERAL';
 
    private $pathToLocalData;

    public function __construct()
    {
        parent::__construct($this::PUBLIC_SPHERE_TYPE);
    }
}