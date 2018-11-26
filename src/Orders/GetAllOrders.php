<?php

declare(strict_types=1);

namespace TrollAndToad\Sellbrite\Orders;

use Carbon\Carbon;
use TrollAndToad\Sellbrite\Core\Core;

class GetAllOrders extends Core
{
    /**
     * @param integer $page Page number
     * @param integer $limit Number of results per page
     * @param string $min_ordered_at Filters orders ordered after date (ISO 8601)
     * @param string $max_ordered_at Filters orders ordered before date (ISO 8601)
     * @param string $sb_status Filters by order status. Accepts: "completed", "canceled", or "open"
     * @param string $sb_payment_status Filters orders by payment status. Accepts: "all", "partial", or "none"
     * @param string $shipment_status Filters by shipment status. Accepts: "all", "partial", or "none"
     *
     * @return string
     */
    public function sendRequest(
        int $page = null,
        int $limit = null,
        string $min_ordered_at = null,
        string $max_ordered_at = null,
        string $sb_status = null,
        string $sb_payment_status = null,
        string $shipment_status = null
    ) {
        // Build the API endpoint
        $url = self::BASE_URI . 'orders';

        // Build the API headers
        $apiHeaders = $this->baseApiHeaders;
        $apiHeaders['headers']['Content-Type'] = 'application/json';

        // Add the page query string if necessary
        if (is_null($page) === false && intval($page) > 0)
        {
            $apiHeaders['query']['page'] = $page;
        }

        // Add the limit query string is necessary. NOTE: The API limits returned order count
        // to 100. The API will -not- allow more to be fetched by a single request.
        if (is_null($limit) === false)
        {
            if (intval($limit) > 100) {
                $apiHeaders['query']['limit'] = 100;
            } else {
                $apiHeaders['query']['limit'] = $limit;
            }
        }

        // Add the min_ordered_at datetime query string (ISO 8601)
        if (is_null($min_ordered_at) === false && $this->validateDateField($min_ordered_at))
        {
            $apiHeaders['query']['min_ordered_at'] = $min_ordered_at;
        }

        // Add the maxn_ordered_at datetime query string (ISO 8601)
        if (is_null($max_ordered_at) === false && $this->validateDateField($max_ordered_at))
        {
            $apiHeaders['query']['max_ordered_at'] = $max_ordered_at;
        }

        // Add the sb_status query string
        if (is_null($sb_status) === false && $this->validateTextField($sb_status))
        {
            $apiHeaders['query']['sb_status'] = $sb_status;
        }

        // Add the sb_payment_status query string
        if (is_null($sb_payment_status) === false && $this->validateTextField($sb_payment_status))
        {
            $apiHeaders['query']['sb_payment_status'] = $sb_payment_status;
        }

        // Add the shipment_status query string
        if (is_null($shipment_status) === false && $this->validateTextField($shipment_status))
        {
            $apiHeaders['query']['shipment_status'] = $shipment_status;
        }

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
                throw new \Exception("401 Unauthorized. You couldn't be authenticated because bad credentials was supplied.");
                break;
            default:
                throw new \Exception('Unknown error.');
        }
    } // End public function sendRequest

    /**
     * @return boolean
     */
    public function validateDateField(string $dateField)
    {
        try {
            Carbon::parse($dateField);
        } catch (\Exception $e)
        {
            return false;
        }

        return true;
    } // public function validateDateField

    /**
     * @return boolean
     */
    public function validateTextField(string $textField)
    {
        switch ($textField)
        {
            case 'completed':
            case 'canceled':
            case 'open':
            case 'all':
            case 'partial':
            case 'none':
                return true;
            default:
                return false;
        }
    } // End public function validateField
} // End class GetWarehouses
