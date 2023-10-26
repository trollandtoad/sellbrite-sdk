<p align="center">
    <a href="https://github.com/trollandtoad/sellbrite-sdk/actions/workflows/run-tests.yml">
        <img alt="GitHub Workflow Status (with event)" src="https://img.shields.io/github/actions/workflow/status/trollandtoad/sellbrite-sdk/run-tests.yml?style=flat-square&cacheSeconds=3600">
    </a>
    <a href="https://codecov.io/gh/trollandtoad/sellbrite-sdk" rel="nofollow">
        <img alt="Codecov" src="https://img.shields.io/codecov/c/github/trollandtoad/sellbrite-sdk?style=flat-square&cacheSeconds=3600">
    </a>
</p>

## Sellbrite SDK

This is a PHP library that wraps the Guzzle HTTP Client to interact with the Sellbrite API.

## Installation

```bash
composer require trollandtoad/sellbrite-sdk
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

 - GET **/variation_groups** - 4 Tests
 - DELETE **/variation_groups/{sku}** - 4 Tests
 - PUT **/variation_groups/{sku}** - 7 Tests

**Total** - 87 Unit Tests

## Report Bugs

Please report bugs to [brclothier@trollandtoad.com](mailto:brclothier@trollandtoad.com)
