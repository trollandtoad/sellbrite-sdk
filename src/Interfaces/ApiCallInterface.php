<?php

declare(strict_types=1);

namespace TrollAndToad\Sellbrite\Interfaces;

interface ApiCallInterface
{
    const BASE_URI = 'https://api.sellbrite.com/v1/';

    public function sendRequest($credentials);
}
