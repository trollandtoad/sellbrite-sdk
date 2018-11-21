<?php

declare(strict_types=1);

namespace TrollAndToad\Sellbrite\Core;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

use Sellbrite\Interfaces\ApiCallInterface;

/**
 * @implements ApiCallInterface
 */
abstract class Core implements ApiCallInterface
{
    /**
     * @var string $apiEndpoint
     */
    protected $apiEndpoint;

    /**
     * @var ClientInterface $httpClient
     */
    protected $httpClient;

    /**
     * @param ClientInterface
     */
    public function __construct(?ClientInterface $httpClient = null)
    {
        $this->httpClient  = $httpClient !== null && $httpClient instanceof ClientInterface ?
            $httpClient : new Client();
    }
}
