<?php

declare(strict_types=1);

namespace dqfan2012\Sellbrite\Test\Warehouses;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use dqfan2012\Sellbrite\Warehouses\PostWarehouse;

class PostWarehouseTest extends TestCase
{
    public function testPostWarehouseApiSuccessfullyPostWarehouse()
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
                '{
                    "message": "Warehouse successfully created.",
                    "warehouse_uuid": "7c4e66ae-7cf5-77d0-7a03-77e7851bdd0"
                }'
            )
        );

        // Instantiate a new PostWarehouse API Object
        $postWarehouse = new PostWarehouse($accountToken, $secretKey, $mockClient);

        $warehouseInfoArr = [
            'warehouse' => [
                'name'               => 'sellbrite-warehouse',
                'sender_name'        => 'faux-3PL',
                'company_name'       => 'buydark',
                'email'              => 'sbwarehouse@sellbrite.com',
                'phone_number'       => '626-123-5678',
                'address_1'          => '44 W. Green St',
                'address_2'          => 'Apt. B',
                'postal_code'        => '91105',
                'city'               => 'Pasadena',
                'region'             => 'CA',
                'country_code'       => 'US',
                'enable_shipstation' => true
            ]
        ];

        // Get the JSON response from the request
        $jsonResponse = $postWarehouse->sendRequest($warehouseInfoArr);

        // Assert the returned JSON response matches the expected data
        $this->assertJsonStringEqualsJsonString(
            $jsonResponse,
            json_encode([
                'message' => 'Warehouse successfully created.',
                'warehouse_uuid' => '7c4e66ae-7cf5-77d0-7a03-77e7851bdd0'
            ])
        );
    } // End public function testPostWarehouseApiSuccessfullyPostWarehouse

    public function testPostWarehouseApiBadWarehouseArray()
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
                '{
                    "message": "Warehouse successfully created.",
                    "warehouse_uuid": "7c4e66ae-7cf5-77d0-7a03-77e7851bdd0"
                }'
            )
        );

        // Instantiate a new PostWarehouse API Object
        $postWarehouse = new PostWarehouse($accountToken, $secretKey, $mockClient);

        // Create a bad warehouse information array
        $warehouseInfoArr = null;

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Get the JSON response from the request
        $jsonResponse = $postWarehouse->sendRequest($warehouseInfoArr);
    } // End public function testPostWarehouseApiBadWarehouseArray

    public function testPostWarehouseApiBadEmailString()
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
                422,
                [ 'Content-Type' => 'application/json' ],
                '{
                    "error": {
                        "email": [
                            "is invalid"
                        ]
                    }
                }'
            )
        );

        // Instantiate a new PostWarehouse API Object
        $postWarehouse = new PostWarehouse($accountToken, $secretKey, $mockClient);

        $warehouseInfoArr = [
            'warehouse' => [
                'name'               => 'sellbrite-warehouse',
                'sender_name'        => 'faux-3PL',
                'company_name'       => 'buydark',
                'email'              => 'sbwarehouse',
                'phone_number'       => '626-123-5678',
                'address_1'          => '44 W. Green St',
                'address_2'          => 'Apt. B',
                'postal_code'        => '91105',
                'city'               => 'Pasadena',
                'region'             => 'CA',
                'country_code'       => 'US',
                'enable_shipstation' => true
            ]
        ];

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Get the JSON response from the request
        $jsonResponse = $postWarehouse->sendRequest($warehouseInfoArr);
    } // End public function testPostWarehouseApiBadEmailString

    public function testPostWarehouseApiBadCredentialsShouldReturnAnException()
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

        // Instantiate a new PostWarehouse API Object
        $postWarehouse = new PostWarehouse($accountToken, $secretKey, $mockClient);

        $warehouseInfoArr = [
            'warehouse' => [
                'name'               => 'sellbrite-warehouse',
                'sender_name'        => 'faux-3PL',
                'company_name'       => 'buydark',
                'email'              => 'sbwarehouse@sellbrite.com',
                'phone_number'       => '626-123-5678',
                'address_1'          => '44 W. Green St',
                'address_2'          => 'Apt. B',
                'postal_code'        => '91105',
                'city'               => 'Pasadena',
                'region'             => 'CA',
                'country_code'       => 'US',
                'enable_shipstation' => true
            ]
        ];

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Send the request and store the response
        $json = $postWarehouse->sendRequest($warehouseInfoArr);
    } // End public function testPostWarehouseApiBadCredentialsShouldReturnAnException

    public function testPostWarehouseApiHandleDefaultError()
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
                500,
                [ 'Content-Type' => 'text/html' ],
                "This is the default error."
            )
        );

        // Instantiate a new PostWarehouse API Object
        $postWarehouse = new PostWarehouse($accountToken, $secretKey, $mockClient);

        $warehouseInfoArr = [
            'warehouse' => [
                'name'               => 'sellbrite-warehouse',
                'sender_name'        => 'faux-3PL',
                'company_name'       => 'buydark',
                'email'              => 'sbwarehouse@sellbrite.com',
                'phone_number'       => '626-123-5678',
                'address_1'          => '44 W. Green St',
                'address_2'          => 'Apt. B',
                'postal_code'        => '91105',
                'city'               => 'Pasadena',
                'region'             => 'CA',
                'country_code'       => 'US',
                'enable_shipstation' => true
            ]
        ];

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Send the request and store the response
        $json = $postWarehouse->sendRequest($warehouseInfoArr);
    } // End public function testPostWarehouseApiHandleDefaultError
} // End class PostWarehouseTest
