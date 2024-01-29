<?php

namespace App\Services\Api\Plugin\Deputados;

use App\Services\Api\Mapping\ApiPlugin;
use App\Services\Api\Plugin\CamaraDeputados;

#[ApiPlugin(
    baseUrl: parent::BASE_URL,
    endpoint: "deputados/{id}",
    method: "GET",
)]
class GetDeputado extends CamaraDeputados
{
    public function get(string $id = ''): array
    {
        if (!$id) {
            throw new \Exception("The parameter Id must be informed.");
        }
        $params = [
            "id" => $id,
            'query' => [],
        ];
        return $this->do($params);
    }
}
