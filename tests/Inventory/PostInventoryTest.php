<?php

declare(strict_types=1);

namespace dqfan2012\Sellbrite\Test\Inventory;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use dqfan2012\Sellbrite\Inventory\PostInventory;

class PostInventoryTest extends TestCase
{
    public function testPostInventoryApiCallSuccessfullyCreatedItems()
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
                201,
                [ 'Content-Type' => 'application/json' ],
                '{ "body": "Inventory successfully created" }'
            )
        );

        $inventoryArray = [
            'inventory' => [
                [
                    'sku' => 'L11M311354',
                    'description' => 'This is a description.',
                    'warehouse_uuid' => 'a8431234-9e24-479c-abf4-1234d5861234',
                    'on_hand' => 1,
                    'bin_location' => 'AM-33-1MNZ2'
                ],
                [
                    'sku' => 'JL1141234',
                    'description' => 'This is a description.',
                    'warehouse_uuid' => 'a8431234-9e24-479c-abf4-1234d5861234',
                    'on_hand' => 4,
                    'bin_location' => 'CR3M-89MN-0P'
                ],
                [
                    'sku' => 'AL11A1M3BC',
                    'description' => 'This is a description.',
                    'warehouse_uuid' => 'a8431234-9e24-479c-abf4-1234d5861234',
                    'on_hand' => 9,
                    'bin_location' => 'TMZN-NN331'
                ],
                [
                    'sku' => 'P3920NMI3',
                    'description' => 'This is a description.',
                    'warehouse_uuid' => 'a8431234-9e24-479c-abf4-1234d5861234',
                    'on_hand' => 6,
                    'bin_location' => 'ABC-DE3-FG1M3N'
                ],
            ]
        ];

        // Instantiate a new PostInventory API Object
        $postInventory = new PostInventory($accountToken, $secretKey, $mockClient);

        // Get the JSON response from the request
        $responseStr = $postInventory->sendRequest($inventoryArray);

        $this->assertEquals($responseStr, 'Inventory successfully created');
    } // End public function testPostInventoryApiCallSuccessfullyCreatedItems

    public function testPostInventoryApiCallBadWarehouseUuid()
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
                404,
                [ 'Content-Type' => 'application/json' ],
                '{ "error": "Warehouse not found" }'
            )
        );

        $inventoryArray = [
            'inventory' => [
                [
                    'sku' => 'L11M311354',
                    'description' => 'This is a description.',
                    'warehouse_uuid' => 'a8431234-9e24-479c-abf4-1234d5861234',
                    'on_hand' => 1,
                    'bin_location' => 'AM-33-1MNZ2'
                ]
            ]
        ];

        // Instantiate a new PostInventory API Object
        $postInventory = new PostInventory($accountToken, $secretKey, $mockClient);

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Send the request
        $response = $postInventory->sendRequest($inventoryArray);
    } // End public function testPostInventoryApiCallBadWarehouseUuid

    public function testPostInventoryApiCallBadAuthentication()
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
                [ 'Content-Type' => 'text/html' ],
                "HTTP Basic: Access denied."
            )
        );

        $inventoryArray = [
            'inventory' => [
                [
                    'sku' => 'L11M311354',
                    'description' => 'This is a description.',
                    'warehouse_uuid' => 'a8431234-9e24-479c-abf4-1234d5861234',
                    'on_hand' => 1,
                    'bin_location' => 'AM-33-1MNZ2'
                ]
            ]
        ];

        // Instantiate a new PostInventory API Object
        $postInventory = new PostInventory($accountToken, $secretKey, $mockClient);

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Send the request
        $response = $postInventory->sendRequest($inventoryArray);
    } // End public function testPostInventoryApiCallBadAuth

    public function testPostInventoryApiCallBadRequestDefaultError()
    {
        // Get the stored credentials
        $accountToken = 'M2930ng';
        $secretKey    = 'MNzmcme982n';

        // Create a mock client object
        $mockClient = \Mockery::mock(ClientInterface::class);

        // The mock client should receive a request call and it should return at PSR-7 Response object
        // cotaining JSON
        $mockClient->shouldReceive('request')->andReturns(
            new Response(
                400,
                [ 'Content-Type' => 'application/json' ],
                'This is the default error.'
            )
        );

        $inventoryArray = [
            'inventory' => [
                [
                    'sku' => 'L11M311354',
                    'description' => 'This is a description.',
                    'warehouse_uuid' => 'a8431234-9e24-479c-abf4-1234d5861234',
                    'on_hand' => 1,
                    'bin_location' => 'AM-33-1MNZ2'
                ]
            ]
        ];

        // Instantiate a new PostInventory API Object
        $postInventory = new PostInventory($accountToken, $secretKey, $mockClient);

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Send the request
        $response = $postInventory->sendRequest($inventoryArray);
    } // End public function testPostInventoryApiCallBadRequestDefaultError

    public function testPostInventoryApiCallError409()
    {
        // Get the stored credentials
        $accountToken = 'M2930ng';
        $secretKey    = 'MNzmcme982n';

        // Create a mock client object
        $mockClient = \Mockery::mock(ClientInterface::class);

        // The mock client should receive a request call and it should return at PSR-7 Response object
        // cotaining JSON
        $mockClient->shouldReceive('request')->andReturns(
            new Response(
                409,
                [ 'Content-Type' => 'application/json' ],
                '{ "body": "Inventory already exists" }'
            )
        );

        $inventoryArray = [
            'inventory' => [
                [
                    'sku' => 'L11M311354',
                    'description' => 'This is a description.',
                    'warehouse_uuid' => 'a8431234-9e24-479c-abf4-1234d5861234',
                    'on_hand' => 1,
                    'bin_location' => 'AM-33-1MNZ2'
                ]
            ]
        ];

        // Instantiate a new PostInventory API Object
        $postInventory = new PostInventory($accountToken, $secretKey, $mockClient);

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Send the request
        $response = $postInventory->sendRequest($inventoryArray);
    } // End public function testPostInventoryApiCallError409
} // End class PostInventoryTest
