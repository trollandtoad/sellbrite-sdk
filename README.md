<p align="center">
    <a href="https://travis-ci.org/trollandtoad/sellbrite-sdk" rel="nofollow">
        <img src="https://travis-ci.org/trollandtoad/sellbrite-sdk.svg?branch=master" alt="Build Status" style="max-width: 100%;">
    </a>
    <a href="https://codecov.io/gh/trollandtoad/sellbrite-sdk" rel="nofollow">
        <img src="https://codecov.io/gh/trollandtoad/sellbrite-sdk/branch/master/graph/badge.svg" alt="codecov" style="max-width: 100%;" />
    </a>
</p>

## Sellbrite SDK

This is a PHP library that wraps the Guzzle HTTP Client to interact with the Sellbrite API.

## Installation

```
$ composer require trollandtoad/sellbrite-sdk
```

## Covered API Calls

**Channels**

- GET **/channels** - 3 Tests

**Inventory**

 - GET **/inventory**
 - PATCH **/inventory**
 - POST **/inventory**
 - PUT **/inventory**

**Orders**

 - GET **/orders**
 - GET **/orders/:sb_order_seq**

**Shipments**

 - POST **/shipments**

**Warehouses**

 - GET **/warehouses**
 - POST **/warehouses**
 - PUT **/warehouses**
 - GET **/warehouses/fulfillments/:uuid**

**Products**

 - GET **/products**
 - POST **/products/{sku}**
 - DELETE **/products/{sku}**

**Variation Groups**

 - [x] GET **/variation_groups** - 4 Tests
 - [x] DELETE **/variation_groups/{sku}** - 4 Tests
 - [x] PUT **/variation_groups/{sku}** - 7 Tests

**Total** - 87 Unit Tests

## Report Bugs

Please report bugs to [brclothier@trollandtoad.com](mailto:brclothier@trollandtoad.com)