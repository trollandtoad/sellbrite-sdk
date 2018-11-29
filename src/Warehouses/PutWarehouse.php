<?php

declare(strict_types=1);

namespace dqfan2012\Sellbrite\Warehouses;

use dqfan2012\Sellbrite\Core\Core;

class PutWarehouse extends Core
{
    /**
     * @param array $warehouseInfoArr Array that holds all the information for the associated warehouse
     */
    public function sendRequest(string $warehouseUuid = null, array $warehouseInfoArr = null)
    {
        if (is_null($warehouseUuid) === true || empty($warehouseUuid) === true)
            throw new \Exception('You have to supply a warehouse uuid for this API request');

        if (is_null($warehouseInfoArr) === true || empty($warehouseInfoArr) === true)
            throw new \Exception('You have to supply an appropriate warehouse information array.');

        // Build the API endpoint
        $url = self::BASE_URI . 'warehouses/' . $warehouseUuid;

        // Build the API headers
        $apiHeaders = $this->baseApiHeaders;
        $apiHeaders['headers']['Content-Type'] = 'application/json';

        // Add the body params
        $apiHeaders['body'] = json_encode($warehouseInfoArr);

        // Send the HTTP request to the API endpoint and get the response stream
        $response = $this->httpClient->request('PUT', $url, $apiHeaders);

        // Get the status code returned with the response
        $statusCode = $response->getStatusCode();

        // Get the response body
        $messageArr = json_decode((string) $response->getBody(), true);

        // Check status code for success or failure
        switch ($statusCode)
        {
            case 200: // OK
            case 202: // Accepted
                return (string) $response->getBody();
                break;
            case 401:
                throw new \Exception("401 Unauthorized - HTTP Basic: Access denied.");
                break;
            case 404:
                throw new \Exception("404 Not Found - "  . $messageArr['error']);
                break;
            default:
                throw new \Exception('This is the default error.');
        }
    } // End public function sendRequest
} // End class PutWarehouse
