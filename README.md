# Flexfone API Client
This is a library for using the Flexfone API.

## Installation
This package can be installed using composer

`composer require dnyg/flexfone-php-client`

PHP 7.1 or greater is required.

## Usage
To use the client just pass your credentials into the constructor of the `Flexfone\ApiClient()`

### Examples

**Getting an employee by localNumber (200)**
```
$client = new Flexfone\ApiClient($pbxId, $key);

$employee = $client->getEmployee(200);
```

**Retrieving all employees**
```
$client = new Flexfone\ApiClient($pbxId, $key);

$employee = $client->getEmployees();
```



## Tests
To run the tests, rename the `tests\config.example.php` to `tests\config.php` and fill it out.

