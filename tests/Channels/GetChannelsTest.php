<?php

declare(strict_types=1);

namespace dqfan2012\Sellbrite\Test\Channels;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use dqfan2012\Sellbrite\Channels\GetChannels;

class GetChannelsTest extends TestCase
{
    public function testChannelsApiRequest()
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
                        "uuid": "test-uuid-1234-5678",
                        "name": "Amazon Channel 1",
                        "state": "active",
                        "channel_type_display_name": "Amazon",
                        "created_at": "2017-01-17T23:14:44+00:00",
                        "site_id": "A1F83G8C2ARO7P",
                        "channel_site_region": "Amazon.co.uk (United Kingdom)"
                    }
                ]'
            )
        );

        // Instantiate a new GetChannels API Object
        $getChannels = new GetChannels($accountToken, $secretKey, $mockClient);

        // Get the JSON response from the request
        $jsonResponse = $getChannels->sendRequest();

        // Assert the returned JSON response matches the expected data
        $this->assertJsonStringEqualsJsonString(
            $jsonResponse,
            json_encode([
                [
                    'uuid'                      => 'test-uuid-1234-5678',
                    'name'                      => 'Amazon Channel 1',
                    'state'                     => 'active',
                    'channel_type_display_name' => 'Amazon',
                    'created_at'                => '2017-01-17T23:14:44+00:00',
                    'site_id'                   => 'A1F83G8C2ARO7P',
                    'channel_site_region'       => 'Amazon.co.uk (United Kingdom)'
                ]
            ])
        );
    } // End public function testChannelsApiRequest

    public function testChannelsApiBadCredentialsRequestShouldReturnAnException()
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

        // Instantiate a new GetChannels API Object
        $getChannels = new GetChannels($accountToken, $secretKey, $mockClient);

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Send the request and store the response
        $response = $getChannels->sendRequest();
    } // End public function testChannelsApiBadCredentialsRequestShouldReturnAnException

    public function testChannelsApiRequestShouldReturnDefaultException()
    {
        // Get the stored credentials
        $accountToken = 'M023hga08932476q';
        $secretKey    = 'N*h94hn1n58';

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

        // Instantiate a new GetChannels API Object
        $getChannels = new GetChannels($accountToken, $secretKey, $mockClient);

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Send the request and store the response
        $jsonResponse = $getChannels->sendRequest();
    } // End public function testBadCredentialsForChannelsApiRequestShouldReturnDefaultException
} // End class GetChannelsTest
