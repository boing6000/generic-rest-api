# Generic REST API

This Laravel 5 package provides easy way for creating REST API based on your models.
You only need to define list of models that will be used in your API.

**WARNING! This package is currenty under development and is not production ready.**

## Instalation

To install Generic REST API package run this command in your project directory

    composer install wilgucki/generic-rest-api

After instalation is finished add service provider in your config/app.php file

    'providers' => [
        //... 
        Wilgucki\GenericRestApi\GenericRestApiServiceProvider::class,
    ]

Next publish package config

    php artisan vendor:publish --provider="Wilgucki\GenericRestApi\GenericRestApiServiceProvider"

## Configuration

Configuration is quite simple. You can set API version numer as well as models
namespace in generic-rest-api.php configuration file.

    return [
        'api-version' => 'v1',
        'model-namespace' => 'App',
        'models' => [
            'Foo'
        ]
    ];

- api-version - this will be added as prefix to API route
- model-namespace - the namespace of models
- models - list of models you want to share via API

## Usage

Available methods:

- GET /api/[version]/[model] - returns list containing all table rows


    [
      {
        "id": 1,
        "name": "some name",
        "email": "some@email.com",
        "created_at": "2015-11-27 08:17:31",
        "updated_at": "2016-01-12 20:47:11"
      },
      {
        "id": 2,
        "name": "another name",
        "email": "another@email.com",
        "created_at": "2016-02-01 12:01:02",
        "updated_at": "2016-02-17 18:12:41"
      }
    ]


- GET /api/[version]/[model]/[id] - returns single row


    {
        "id": 1,
        "name": "some name",
        "email": "some@email.com",
        "created_at": "2015-11-27 08:17:31",
        "updated_at": "2016-01-12 20:47:11"
    }


- POST /api/[version]/[model] - creates new row from query parameters
- PUT /api/[version]/[model]/[id] - updates existing row using query parameters
- DELETE /api/[version]/[model]/[id] - deletes row

Path params:

- [version] - API version defined in configuration file
- [model] - lower case and snake case name of the model. For instance, model SomeClass should be accessed via _some_class_
- [id] - row id

Methods POST, PUT and DELETE return operation status in reponse. It looks like this

    {"success":true}
    
If there was an error, _success_ parameter will be set to _false_ and propper message will be added to the response.

While creating or updating row, remember to name parameters the same way as they are named in table.

## TODO

- validation
- pagination

