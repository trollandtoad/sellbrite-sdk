<?php

declare(strict_types=1);

namespace dqfan2012\Sellbrite\Test\Products;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use dqfan2012\Sellbrite\Products\DeleteProduct;

class DeleteProductTest extends TestCase
{
    public function testDeleteProductSuccessfullyDeleteAProduct()
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
                'Succesfully deleted product.'
            )
        );

        $sku = '1903275';

        // Create a new instance of DeleteProduct
        $deleteProduct = new DeleteProduct($accountToken, $secretKey, $mockClient);

        // Send the request and get the response object
        $responseStr = $deleteProduct->sendRequest($sku);

        // Assert the returned JSON response matches the expected data
        $this->assertEquals('Succesfully deleted product.', $responseStr);
    } // End public function testPostProductSuccessfullyPostAProduct

    public function testPostProductNotProvidingASkuShouldReturnAnException()
    {
        // Get the stored credentials
        $accountToken = 'M08923hgm';
        $secretKey    = 'Sg934qjteaj923464ha';

        // Create a mock client object
        $mockClient = \Mockery::mock(ClientInterface::class);

        // The mock client should receive a request call and it should return at PSR-7 Response object
        // cotaining an error
        $mockClient->shouldReceive('request')->andReturns(
            new Response(
                200,
                [ 'Content-Type' => 'text/html' ],
                "You failed to supply a SKU."
            )
        );

        $sku = '';

        // Instantiate a new GetChannels API Object
        $deleteProduct = new DeleteProduct($accountToken, $secretKey, $mockClient);

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Send the request and store the response
        $response = $deleteProduct->sendRequest($sku);
    } // End public function testPostProductNotProvidingASkuShouldReturnAnException

    public function testPostProductProvidingBadCredentialsThrowsException()
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

        $sku = '12377892';

        // Instantiate a new GetChannels API Object
        $deleteProduct = new DeleteProduct($accountToken, $secretKey, $mockClient);

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Send the request and store the response
        $response = $deleteProduct->sendRequest($sku);
    } // End public function testPostProductProvidingBadCredentialsThrowsException

    public function testPostProductThrowDefaultException()
    {
        // Get the stored credentials
        $accountToken = 'a2906ynasdl';
        $secretKey    = '23zmi02607gh';

        // Create a mock client object
        $mockClient = \Mockery::mock(ClientInterface::class);

        // The mock client should receive a request call and it should return at PSR-7 Response object
        // cotaining an error
        $mockClient->shouldReceive('request')->andReturns(
            new Response(
                405,
                [ 'Content-Type' => 'text/html' ],
                "This is the default error."
            )
        );

        $sku = '12377892';

        // Instantiate a new GetChannels API Object
        $deleteProduct = new DeleteProduct($accountToken, $secretKey, $mockClient);

        // Expect an exception from the request
        $this->expectException(\Exception::class);

        // Send the request and store the response
        $response = $deleteProduct->sendRequest($sku);
    } // End public function testPostProductThrowDefaultException
} // End class DeleteProductTest
