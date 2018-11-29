<?php

declare(strict_types=1);

namespace TrollAndToad\Sellbrite\Test\Inventory;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use TrollAndToad\Sellbrite\Inventory\PutInventory;

class PutInventoryTest extends TestCase
{
    public function testPutInventoryApiCallSuccessfullyUpsertItems()
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
                    "body": "Request received"
                }'
            )
        );

        $inventoryArray = [
            'inventory' => [
                [
                    'sku' => 'L11M311354',
                    'description' => 'This is a description.',
                    'warehouse_uuid' => 'a8431234-9e24-479c-abf4-1234d5861234',
                    'on_hand' => 1,
                    'available' => 1,
                    'bin_location' => 'AM-33-1MNZ2'
                ],
                [
                    'sku' => 'JL1141234',
                    'description' => 'This is a description.',
                    'warehouse_uuid' => 'a8431234-9e24-479c-abf4-1234d5861234',
                    'on_hand' => 4,
                    'available' => 4,
                    'bin_location' => 'CR3M-89MN-0P'
                ],
                [
                    'sku' => 'AL11A1M3BC',
                    'description' => 'This is a description.',
                    'warehouse_uuid' => 'a8431234-9e24-479c-abf4-1234d5861234',
                    'on_hand' => 9,
                    'available' => 9,
                    'bin_location' => 'TMZN-NN331'
                ],
                [
                    'sku' => 'P3920NMI3',
                    'description' => 'This is a description.',
                    'warehouse_uuid' => 'a8431234-9e24-479c-abf4-1234d5861234',
                    'on_hand' => 6,
                    'available' => 6,
                    'bin_location' => 'ABC-DE3-FG1M3N'
                ],
            ]
        ];

        // Instantiate a new PutInventory API Object
        $putInventory = new PutInventory($accountToken, $secretKey, $mockClient);

        // Get the JSON response from the request
        $responseStr = $putInventory->sendRequest($inventoryArray);

        $this->assertEquals($responseStr, 'Request received');
    } // End public function testPutInventoryApiCallSuccessfullyUpsertItems
} // End class PostInventoryTest
