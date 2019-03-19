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

 - GET **/variation_groups**
 - DELETE **/variation_groups/{sku}**
 - PUT **/variation_groups/{sku}**
