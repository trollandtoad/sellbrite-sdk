<p align="center">
    <a href="https://travis-ci.org/dqfan2012/sellbrite-sdk" rel="nofollow">
        <img src="https://travis-ci.org/dqfan2012/sellbrite-sdk.svg?branch=master" alt="Build Status" style="max-width: 100%;">
    </a>
    <a href="https://codecov.io/gh/dqfan2012/sellbrite-sdk" rel="nofollow">
        <img src="https://codecov.io/gh/dqfan2012/sellbrite-sdk/branch/master/graph/badge.svg" alt="codecov" style="max-width: 100%;" />
    </a>
</p>

## Sellbrite SDK

This is a PHP library that wraps the Guzzle HTTP Client to interact with the Sellbrite API.

## Installation

```
$ composer require dqfan2012/sellbrite-sdk
```

## Report Bugs

Please report bugs to dqfan2012@gmail or sastidham@trollandtoad.com

## Covered API Calls

**Channels**

 - [x] GET **/channels** - 3 Tests

**Inventory**

 - [x] GET **/inventory** - 7 Tests
 - [x] PATCH **/inventory** - 5 Tests
 - [x] POST **/inventory** - 5 Tests
 - [x] PUT **/inventory** - 4 Tests

**Orders**

 - [x] GET **/orders** - 7 Tests
 - [x] GET **/orders/:sb_order_seq** - 3 Tests

**Shipments**

 - [x] POST **/shipments** - 6 Tests

**Warehouses**

 - [x] GET **/warehouses** - 3 Tests
 - [x] POST **/warehouses** - 5 Tests
 - [x] PUT **/warehouses** - 6 Tests
 - [x] GET **/warehouses/fulfillments/:uuid** - 5 Tests

**Products**

 - [x] GET **/products** - 4 Tests
 - [x] POST **/products/{sku}** - 5 Tests
 - [x] DELETE **/products/{sku}** - 4 Tests

**Variation Groups**

 - [x] GET **/variation_groups** - 4 Tests
 - [x] DELETE **/variation_groups/{sku}** - 4 Tests
 - [x] PUT **/variation_groups/{sku}** - 7 Tests

**Total** - 87 Unit Tests
