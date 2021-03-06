<?php

declare(strict_types=1);

namespace TrollAndToad\Sellbrite\Test\Warehouses;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use TrollAndToad\Sellbrite\Warehouses\PutWarehouse;

class PutWarehouseTest extends TestCase
{
    public function testPutWarehouseApiSuccessfullyUpdatesWarehouseResource()
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
                202,
                [ 'Content-Type' => 'application/json' ],
                '{
                    "message": "Warehouse successfully updated."
                }'
            )
        );

        // Instantiate a new PostWarehouse API Object
        $putWarehouse = new PutWarehouse($accountToken, $secretKey, $mockClient);

        $warehouseUuid = '19dcad9a-0123-445f-83d4-35a62612382';

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
        $jsonResponse = $putWarehouse->sendRequest($warehouseUuid, $warehouseInfoArr);

        // Assert the returned JSON response matches the expected data
        $this->assertJsonStringEqualsJsonString(
            $jsonResponse,
            json_encode([
                'message' => 'Warehouse successfully updated.'
            ])
        );
    } // End public function testPutWarehouseApiSuccessfullyUpdatesWarehouseResource

    public function testPutWarehouseApiTestBadWarehouseUuid()
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
                202,
                [ 'Content-Type' => 'application/json' ],
                '{
                    "message": "Warehouse successfully updated."
                }'
            )
        );

        // Instantiate a new PostWarehouse API Object
        $putWarehouse = new PutWarehouse($accountToken, $secretKey, $mockClient);

        $warehouseUuid = '';

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

        // Get the JSON response from the request
        $jsonResponse = $putWarehouse->sendRequest($warehouseUuid, $warehouseInfoArr);
    } // End public function testPutWarehouseApiTestBadWarehouseUuid

    public function testPutWarehouseApiTestBadWarehouseInfoArr()
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
                202,
                [ 'Content-Type' => 'application/json' ],
                '{
                    "message": "Warehouse successfully updated."
                }'
            )
        );

        // Instantiate a new PostWarehouse API Object
        $putWarehouse = new PutWarehouse($accountToken, $secretKey, $mockClient);

        $warehouseUuid = '19dcad9a-0123-445f-83d4-35a62612382';

        $warehouseInfoArr = null;

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Get the JSON response from the request
        $jsonResponse = $putWarehouse->sendRequest($warehouseUuid, $warehouseInfoArr);
    } // End public function testPutWarehouseApiTestBadWarehouseInfoArr

    public function testPutWarehouseApiTestBadAuth()
    {
        // Get the stored credentials
        $accountToken = '';
        $secretKey    = '';

        // Create a mock client object
        $mockClient = \Mockery::mock(ClientInterface::class);

        // The mock client should receive a request call and it should return at PSR-7 Response object
        // cotaining JSON
        $mockClient->shouldReceive('request')->andReturns(
            new Response(
                401,
                [ 'Content-Type' => 'application/json' ],
                'HTTP Basic: Access denied.'
            )
        );

        // Instantiate a new PostWarehouse API Object
        $putWarehouse = new PutWarehouse($accountToken, $secretKey, $mockClient);

        $warehouseUuid = '19dcad9a-0123-445f-83d4-35a62612382';

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

        // Get the JSON response from the request
        $jsonResponse = $putWarehouse->sendRequest($warehouseUuid, $warehouseInfoArr);
    } // End public function testPutWarehouseApiTestBadAuth

    public function testPutWarehouseApiTestWarehouseNotFound()
    {
        // Get the stored credentials
        $accountToken = 'N8209ngasnd89032';
        $secretKey    = 'M023hgh032h';

        // Create a mock client object
        $mockClient = \Mockery::mock(ClientInterface::class);

        // The mock client should receive a request call and it should return at PSR-7 Response object
        // cotaining JSON
        $mockClient->shouldReceive('request')->andReturns(
            new Response(
                404,
                [ 'Content-Type' => 'application/json' ],
                '{
                    "error": "Warehouse not found"
                  }'
            )
        );

        // Instantiate a new PostWarehouse API Object
        $putWarehouse = new PutWarehouse($accountToken, $secretKey, $mockClient);

        $warehouseUuid = '19dcad9a-0123-445f-83d4-35a62612382';

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

        // Get the JSON response from the request
        $jsonResponse = $putWarehouse->sendRequest($warehouseUuid, $warehouseInfoArr);
    } // End public function testPutWarehouseApiTestBadAuth

    public function testPutWarehouseApiTestDefaultError()
    {
        // Get the stored credentials
        $accountToken = 'N8209ngasnd89032';
        $secretKey    = 'M023hgh032h';

        // Create a mock client object
        $mockClient = \Mockery::mock(ClientInterface::class);

        // The mock client should receive a request call and it should return at PSR-7 Response object
        // cotaining JSON
        $mockClient->shouldReceive('request')->andReturns(
            new Response(
                500,
                [ 'Content-Type' => 'application/json' ],
                'This is the default error.'
            )
        );

        // Instantiate a new PostWarehouse API Object
        $putWarehouse = new PutWarehouse($accountToken, $secretKey, $mockClient);

        $warehouseUuid = '19dcad9a-0123-445f-83d4-35a62612382';

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

        // Get the JSON response from the request
        $jsonResponse = $putWarehouse->sendRequest($warehouseUuid, $warehouseInfoArr);
    } // End public function testPutWarehouseApiTestDefaultError
} // End class PutWarehouseTest
