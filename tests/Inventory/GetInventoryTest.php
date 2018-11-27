<?php

declare(strict_types=1);

namespace TrollAndToad\Sellbrite\Test\Inventory;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use TrollAndToad\Sellbrite\Inventory\GetAllInventory;

class GetAllInventoryTest extends TestCase
{
    public function testTrue()
    {
        $this->assertTrue(true);
    }
} // End class GetAllInventoryTest
