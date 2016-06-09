README
======

Navitia Component is a PHP library to query __Navitia 2__ Api (http://api.navitia.io),
and controls query parameters.


Requirements
------------

- PHP: >=5.3.3
- a Navitia token


Installation
------------

Using composer:

    composer require "canaltp/navitia":"~1.2"


How to use NavitiaComponent ?
-----------------------------

### Basic usage

Configuration:

``` php
use Navitia\Component\Service\ServiceFacade;

// Configuration
$config = array(
    'url' => 'api.navitia.io',
    'token' => '3b036afe-0110-4202-b9ed-99718476c2e0', // This token has an access to sandbox data
);

$client = ServiceFacade::getInstance(new \Psr\Log\NullLogger());
$client->setConfiguration($config);
```

Query example:

``` php
use Doctrine\Common\Annotations\AnnotationRegistry;

// must be called to register Doctrine annotations
AnnotationRegistry::registerLoader('class_exists');

$query = array(
    'api' => 'journeys',
    'parameters' => array(
        'from' => '2.3749036;48.8467927',
        'to' => '2.2922926;48.8583736',
    ),
);

$result = $client->call($query); // Returns an object with Api result
```

Config parameters:

| Name                | Type       | Description             | Accepted values    | Default value |
| :------------------ | :--------- |:----------------------: | :----------------: | ------------: |
| `url`   (required)  | `string`   | Base url of Navitia     |                    |               |
| `token` (required)  | `string`   | Your token              |                    |               |
| `version`           | `string`   | Api version             | `v1`               | `v1`          |
| `format`            | `string`   | Wanted output format    | `json`, `object`   | `object`      |

### Uses cases

Navitia component supports two apis:

1. Journeys
2. Coverage

#### Journeys

Check documentation to see which parameters can be provided: http://doc.navitia.io/#journeys

Example of an itinerary:

``` php
$query = array(
    'api' => 'journeys',
    'parameters' => array(
        'from' => '2.3749036;48.8467927',
        'to' => '2.2922926;48.8583736',
    )
);
```


#### Coverage

Check documentation to see which parameters can be provided: http://doc.navitia.io/#coverage

Example, retrieve metadata about a coverage:

``` php
$query = array(
    'api' => 'coverage',
    'parameters' => array(
        'region' => 'sandbox',
    ),
);
```


### Calling any other Api

To query Navitia with any other url using this component
and the config you have provided, this pattern do the trick:

``` php
$query = array(
    'api' => 'coverage',
    'parameters' => array(
        'region' => 'sandbox',                          // Coverage name
        'path_filter' => 'stop_areas?variable=value',   // Url to call
    ),
);

$result = $client->call($query);
// Will call http://api.navitia.io/v1/coverage/sandbox/stop_areas?variable=value
```


### Using query builder

You can use a query builder:

``` php
use Navitia\Component\Request\JourneysRequest;
use Navitia\Component\Request\Parameters\JourneysParameters;

$query = new JourneysRequest();

$actionParameters = new JourneysParameters();

$actionParameters
    ->setFrom('2.3749036;48.8467927')
    ->setTo('2.2922926;48.8583736')
    ->setDatetime('20160819T153000')
;

$query->setParameters($actionParameters);

$result = $client->call($query);
```


Running Tests
-----------------------------

You have to provide a Navitia token through an OS environment variable `NAVITIA_TOKEN`:

``` bash
export NAVITIA_TOKEN=your-token-xxxx-xxxx
phpunit
```


Contributing
------------

[View all contributors](https://github.com/CanalTP/NavitiaComponent/graphs/contributors)

License
-------

The library is under [GNU GPL-v3 License](LICENSE.txt).
