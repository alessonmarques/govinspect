<?php

namespace App\Services\Api\Plugin\Deputados;

use App\Services\Api\Mapping\ApiPlugin;
use App\Services\Api\Plugin\CamaraDeputados;

#[ApiPlugin(
    baseUrl: parent::BASE_URL,
    endpoint: "deputados",
    method: "GET",
)]
class GetDeputados extends CamaraDeputados
{
    public function getList(array $query = []): array
    {
        $params = [
            'query' => $query,
        ];
        return $this->do($params);
    }
}
