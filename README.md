# Navitia Component

Navitia Component is a PHP library to query __Navitia__ Api (https://api.navitia.io),
and controls query parameters.


## Requirements

- PHP: >=7.4
- a Navitia token

> Note:
> If you don't have a Navitia token yet, you have to register here: https://navitia.io/register

## Choose your version

- NavitiaComponent v1.x.x used by legacy projects in production (example NMM Realtime)

- NavitiaComponent v2.x.x compatible with frameworks like Symfony4

- NavitiaComponent v3.0.0 compatible with modern frameworks like Symfony5.4, with old firm name CanalTP

- NavitiaComponent v3.1.x compatible with modern frameworks like Symfony5.4, with present firm name Hove





## Installation

Using composer:

    composer require "hove/navitia":"^3.1"


example for previous versions (before v3.1.x, deprecated)

    composer require "canaltp/navitia":"~2.0"


## How to use NavitiaComponent ?

### By autowire

In services.yaml file of your app, add this :
``` yaml
    navitia_component:
        class: Navitia\Component\Service\ServiceFacade
        factory: [Navitia\Component\Service\ServiceFacade, getInstance]
        calls:
            - [ setCache, ["@cache.app.taggable"]]
            - [ setConfiguration, ["%navitia_config%"]]
```

And then add `@navitia_component` to the service that used NavitiaComponent like this :
``` yaml
    App\Service\Navitia:
        class: App\Service\Navitia
        arguments: ['@navitia_component']
```

Set configuration:

You can pass an array of config with the `setConfiguration` function.

``` php
namespace App\Service;

use Navitia\Component\Service\ServiceFacade;

class Navitia
{
    private ServiceFacade $navitiacomponent;

    function __construct(ServiceFacade $navitiacomponent)
    {
        $this->navitiacomponent = $navitiacomponent;
        // Configuration
        $config = array(
            'url' => 'api.navitia.io',
            'token' => '3b036afe-4242-abcd-4242-99718476c2e0', // Example of token
        );
        $this->navitiacomponent->setConfiguration($config);
    }
}
```

| Name                  | Type       | Description             | Accepted values    | Default value |
| :------------------   | :--------- |:----------------------: | :----------------: | ------------: |
| `url`   (required)    | `string`   | Base url of Navitia     |                    |               |
| `token` (required)    | `string`   | Your token              |                    |               |
| `timeout`             | `int`      | Navitia timeout (in ms) |                    |  `6000`       |
| `version`             | `string`   | Api version             | `v1`               | `v1`          |
| `format`              | `string`   | Wanted output format    | `json`, `object`   | `object`      |


Query example:

``` php
$query = array(
    'api' => 'journeys',
    'parameters' => array(
        'from' => '2.3749036;48.8467927',
        'to' => '2.2922926;48.8583736',
    ),
);

$result = $this->navitiacomponent->call($query); // Returns an object with Api result
```

Config parameters:



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

$result = $this->navitiacomponent->call($query);
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

$result = $this->navitiacomponent->call($query);
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

$result = $this->navitiacomponent->call($query);
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

$result = $this->navitiacomponent->call($query);
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

$result = $this->navitiacomponent->call($query);
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

$result = $this->navitiacomponent->call($query);
```


## Running Tests

For this part, you should use docker (need install) and launch it with :

```shell
make all_tests_dev
```

## License

The library is under [MIT](LICENSE).
