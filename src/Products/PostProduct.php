<?php

declare(strict_types=1);

namespace dqfan2012\Sellbrite\Products;

use Carbon\Carbon;
use dqfan2012\Sellbrite\Core\Core;

/**
 * The Product API isn't documented enough. Will not use until it is.
 */
class PostProduct extends Core
{
    /**
     * @param string $sku The SKU of the product
     * @param array $productInfoArr An array containing all the info related to the product
     */
    public function sendRequest(string $sku = null, array $productInfoArr = null)
    {
        if (is_null($sku) === true || empty($sku) === true)
            throw new \Exception('You failed to supply a SKU.');

        if (is_null($productInfoArr) === true)
            throw new \Exception('You failed to supply a product information array.');

        // Build the API endpoint
        $url = self::BASE_URI . 'products/' . $sku;

        // Build the API headers
        $apiHeaders = $this->baseApiHeaders;
        $apiHeaders['headers']['Content-Type'] = 'application/json';

        // Create the body
        $apiHeaders['body'] = json_encode($productInfoArr);

        // Send the HTTP request to the API endpoint and get the response stream
        //$response = $this->httpClient->request('POST', $url, $apiHeaders);

        // Get the status code returned with the response
        //$statusCode = $response->getStatusCode();

        // Get the response body
        //$messageArr = json_decode((string) $response->getBody(), true);

        // Check status code for success or failure
        // switch ($statusCode)
        // {
        //     case 200:
        //         return $messageArr['body'];
        //     case 401:
        //         throw new \Exception("401 Unauthorized - HTTP Basic: Access denied.");
        //         break;
        //     case 404:
        //         throw new \Exception('404 Not Found - ' . $messageArr['error']);
        //         break;
        //     default:
        //         throw new \Exception('This is the default error.');
        // }
    } // End public function sendRequest
} // End class PostProduct
