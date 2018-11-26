<?php

declare(strict_types=1);

namespace TrollAndToad\Sellbrite\Warehouses;

use TrollAndToad\Sellbrite\Core\Core;

class GetWarehouses extends Core
{
    public function sendRequest()
    {
        // Build the API endpoint
        $url = self::BASE_URI . 'warehouses';

        // Build the API headers
        $apiHeaders = $this->baseApiHeaders;
        $apiHeaders['headers']['Content-Type'] = 'application/json';

        // Send the HTTP request to the API endpoint and get the response stream
        $response = $this->httpClient->request('GET', $url, $apiHeaders);

        // Get the status code returned with the response
        $statusCode = $response->getStatusCode();

        // Check status code for success or failure
        switch ($statusCode)
        {
            case 200:
                return (string) $response->getBody();
                break;
            case 401:
                throw new \Exception("401 Unauthorized. You couldn't be authenticated because bad credentials were supplied.");
                break;
            default:
                throw new \Exception('Unknown error.');
        }
    } // End public function sendRequest
} // End class GetWarehouses
