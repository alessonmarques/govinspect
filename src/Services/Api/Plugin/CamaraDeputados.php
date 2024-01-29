<?php

namespace App\Services\Api\Plugin;

use App\Services\Api\PluginAbstract;

class CamaraDeputados extends PluginAbstract
{
    protected const BASE_URL = "https://dadosabertos.camara.leg.br/api/v2/";
}
