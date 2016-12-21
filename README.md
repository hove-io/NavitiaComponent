Navitia Component
=================

Navitia Component is a PHP library to query __Navitia 2__ Api (http://api.navitia.io),
and controls query parameters.


Requirements
------------

- PHP: >=5.3.3
- a Navitia token

> Note:
> If you don't have a Navitia token yet, you have to register here: http://navitia.io/register

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

Navitia component supports these apis:

- Journeys
- Coverage
- Departures

#### Journeys

Example of an itinerary:

``` php
$query = array(
    'api' => 'journeys',
    'parameters' => array(
        'from' => '2.3749036;48.8467927',
        'to' => '2.2922926;48.8583736',
    ),
);

$result = $client->call($query);
```

See also: http://doc.navitia.io/#journeys


#### Coverage

Example, retrieve metadata about a coverage:

``` php
$query = array(
    'api' => 'coverage',
    'parameters' => array(
        'region' => 'sandbox',
    ),
);

$result = $client->call($query);
```

See also: http://doc.navitia.io/#coverage


#### Departures

Example, get all next departures of a line and at a datetime:

``` php
$query = array(
    'api' => 'departures',
    'parameters' => array(
        'region' => 'sandbox',
        'path_filter' => '/lines/line:RAT:M1/departures?from_datetime=20160615T1337'
    ),
);

$result = $client->call($query);
```

See also: http://doc.navitia.io/#departures


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

Using query builder to get all next departures:

``` php
use Navitia\Component\Request\Parameters\CoverageDeparturesParameters;
use Navitia\Component\Request\DeparturesRequest;

$query = new DeparturesRequest();
$query->setRegion('sandbox')->setPathFilter('lines/line:RAT:M1');

$actionParameters = new CoverageDeparturesParameters();
$actionParameters->setDuration(1);
$actionParameters->setFromDatetime('20160615T1337');
$actionParameters->setForbiddenUris(['lines', 'modes']);
$actionParameters->setDataFreshness('realtime');

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

The library is under [MIT](LICENSE.md).
