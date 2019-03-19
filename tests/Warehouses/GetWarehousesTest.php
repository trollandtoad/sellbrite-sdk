<?php

declare(strict_types=1);

namespace TrollAndToad\Sellbrite\Test\Warehouses;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use TrollAndToad\Sellbrite\Warehouses\GetWarehouses;

class GetWarehousesTest extends TestCase
{
    public function testWarehouseApiGetWarehousesRequest()
    {
        // Get the stored credentials
        $accountToken = 'am2902ngt3Nn';
        $secretKey    = 'happy28bananas';

        // Create a mock client object
        $mockClient = \Mockery::mock(ClientInterface::class);

        // The mock client should receive a request call and it should return at PSR-7 Response object
        // cotaining JSON
        $mockClient->shouldReceive('request')->andReturns(
            new Response(
                200,
                [ 'Content-Type' => 'application/json' ],
                '[
                    {
                        "uuid": "test-uuid-7891-1234",
                        "name": "Local Warehouse",
                        "inventory_master": "Sellbrite",
                        "address_1": "1 Octopus Way",
                        "address_2":  "Apt. A",
                        "city": "Alhambra",
                        "state_region": "CA",
                        "postal_code": "91801",
                        "country_code": "US",
                        "archived": false
                    }
                ]'
            )
        );

        // Instantiate a new GetWarehouses API Object
        $getWarehouses = new GetWarehouses($accountToken, $secretKey, $mockClient);

        // Get the JSON response from the request
        $jsonResponse = $getWarehouses->sendRequest();

        // Assert the returned JSON response matches the expected data
        $this->assertJsonStringEqualsJsonString(
            $jsonResponse,
            json_encode([
                [
                    'uuid'             => 'test-uuid-7891-1234',
                    'name'             => 'Local Warehouse',
                    'inventory_master' => 'Sellbrite',
                    'address_1'        => '1 Octopus Way',
                    'address_2'        =>  'Apt. A',
                    'city'             => 'Alhambra',
                    'state_region'     => 'CA',
                    'postal_code'      => '91801',
                    'country_code'     => 'US',
                    'archived'         => false
                ]
            ])
        );
    } // End public function testWarehouseApiGetWarehousesRequest

    public function testWarehouseApiBadCredentialsShouldReturnAnException()
    {
        // Get the stored credentials
        $accountToken = '';
        $secretKey    = '';

        // Create a mock client object
        $mockClient = \Mockery::mock(ClientInterface::class);

        // The mock client should receive a request call and it should return at PSR-7 Response object
        // cotaining an error
        $mockClient->shouldReceive('request')->andReturns(
            new Response(
                401,
                [ 'Content-Type' => 'text/html' ],
                "HTTP Basic: Access denied."
            )
        );

        // Instantiate a new GetWarehouses API Object
        $getWarehouses = new GetWarehouses($accountToken, $secretKey, $mockClient);

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Send the request and store the response
        $json = $getWarehouses->sendRequest();
    } // End public function testWarehouseApiBadCredentialsShouldReturnAnException

    public function testWarehouseApiRequestShouldReturnDefaultException()
    {
        // Get the stored credentials
        $accountToken = 'M9023gna';
        $secretKey    = '239320hag802h328';

        // Create a mock client object
        $mockClient = \Mockery::mock(ClientInterface::class);

        // The mock client should receive a request call and it should return at PSR-7 Response object
        // cotaining an error
        $mockClient->shouldReceive('request')
            ->andReturns(new \GuzzleHttp\Psr7\Response(
                400,
                [ 'Content-Type' => 'application/json' ],
                "This is the default error."
            )
        );

        // Instantiate a new GetWarehouses API Object
        $getWarehouses = new GetWarehouses($accountToken, $secretKey, $mockClient);

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Send the request and store the response
        $jsonResponse = $getWarehouses->sendRequest();
    } // End public function testWarehouseApiRequestShouldReturnDefaultException
} // End class GetWarehouseTest
