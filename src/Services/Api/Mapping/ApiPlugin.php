<?php

declare(strict_types=1);

namespace App\Services\Api\Mapping;

use Attribute;

/**
 * @Annotation
 * @Target("CLASS")
 * @template T of object
 */
#[Attribute(Attribute::TARGET_CLASS)]
class ApiPlugin
{
    /**
     * @var string
     * @readonly
     */
    public $baseUrl;

    /**
     * @var string
     * @readonly
     */
    public $endpoint;

    /**
     * @var string
     * @readonly
     */
    public $method;

    public function __construct(
        string $baseUrl = '',
        string $endpoint = '',
        string $method = '',
    ) {
        $this->baseUrl = $baseUrl;
        $this->endpoint = $endpoint;
        $this->method = $method;
    }
}
