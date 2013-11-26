README
======
What is NavitiaComponent ?
---------------------------
Le composant Navitia permet de faire des appels à l'API __Navitia 2__
et de contrôler les paramètres.

NavitiaComponent est une librairie full-stack PHP 5.3.
Il peut être associé à un framework (Symfony, Zend, ...).

Requirements
------------
1. PHP: >=5.3.3 - NavitiaComponent utilise PHP 5.3.3 et plus.
2. Psr/Log: ~1.0 - Pour utiliser un logger, il faut qu'il implémente
l'interface LoggerInterface de Psr

Installation
------------
Pour installer NavitiaComponent il faut utiliser composer.

1. Ouvrir votre composer.json
2. Placer à la dernière ligne de vos require "canaltp/navitia": "dev-master"
(dev-master ou la dernière version stable)
3. Placer dans vos repositories le type et l'url de packagist

    {
        ...
        "require": {
            ...
            "canaltp/navitia": "dev-master"
        },
        "repositories": [
            {
                "type": "composer",
                "url": "http://packagist.canaltp.fr"
            },
            ...
        ],
        ...
    }


How to use NavitiaComponent ?
-----------------------------
NavitiaComponent propose une utilisation simple et une utilisation avancée.

### 1 - Utilisation simple ###

#### 1.1 - Configuration ####

##### 1.1.1 - Paramètres #####

La configuration est sous la forme d'un tableau (array).

| Parametres          | Type       |Explication              | Valeurs acceptées  | Valeur défaut |
| :------------------ | :--------- |:----------------------: | :----------------: | ------------: |
| url (obligatoires)  | string     | Url d'appel navitia     |                    |               |
| version (optionnel) | string     | Version de l'api navitia| v1                 | v1            |
| format (optionnel)  | string     | Format de la sortie     | 'json', 'object'   | object        |

##### 1.1.2 - Exemple d'utilisation #####

    // Configuration
    $config = array(
        'url' => 'http://navitia2-ws.ctp.dev.canaltp.fr',
	    'format' => 'json'
    );

#### 1.2 - Appel Navitia ####

Nous supportons  deux API Navitia :

1. Coverage
2. Journeys

##### 1.2.1 - Paramètres #####

Pour ces deux API, nous pouvons passer les paramètres sous la forme d'un "String" ou d'un "Array".

###### 1.2.1.1 Journeys ######

| Parametres                | Type                  |Explication              | Valeurs acceptées  |
| :------------------------ | :-------------------- |:----------------------: | :----------------: |
| api (obligatoires)        | string                | api journeys de Navitia |journeys            |
| parameters (obligatoires) | mixed (string, array) | parametres journeys     |                    |

###### 1.2.1.1.2 Exemple parameters (Array) ######

Pour Journeys, le passage des paramètres peut se faire de deux manières:

    // 1. Un tableau de paramètres
    $query = array(
        'api' => 'journeys',
    	'parameters' => array(
    		'from' => 'stop_area:TAN:SA:COMM',
    		'to' => 'stop_area:SCF:SA:SAOCE87481051',
    		'datetime' => '20130819T153000',
    		'datetime_represents' => 'departure'
    	)
    );


    // 2. Un tableau de paramètres contenant un tableau de paramètres
    $query = array(
        'api' => 'journeys',
    	'parameters' => array(
    		'parameters' => array(
    			'from' => 'stop_area:TAN:SA:COMM',
    			'to' => 'stop_area:SCF:SA:SAOCE87481051',
    			'datetime' => '20130819T153000',
    			'datetime_represents' => 'departure'
    		)
    	)
    );

###### 1.2.1.1.3 Exemple parameters (String) ######

    // parameters string avec Journeys
    $query = array(
        'api' => 'journeys',
    	'parameters' => '?from=stop_area:TAN:SA:COMM&to=stop_area:SCF:SA:SAOCE87481051&'.
            'datetime=20130819T153000&datetime_represents=departure'
    );

###### 1.2.1.2 Coverage ######

| Parametres                 | Type               |Explication              | Valeurs acceptées  |
| :------------------------- | :----------------- |:----------------------: | :----------------: |
| api (obligatoires)         | string             | api coverage de Navitia | coverage           |
| parameters (obligatoires)  | array              | parametres coverage     |                    |

###### 1.2.1.2.1 Paramètres Coverage #####
 Les paramètres de coverage sont plus complexes que ceux de journeys.

| Parametres Coverage      | Type                  |Explication              | Exemples           |
| :----------------------- | :-------------------- |:----------------------: | :----------------: |
| region (obligatoires)    | string                | Region                  | 'centre'           |
| path_filter              | string                | Filtre de coverage      | 'lines/line_id'    |
| action                   | string                | l'api de coverage       | 'route_schedules'  |
| parameters               | mixed (array, string) | paramètres de l'action  |                    |


###### 1.2.1.2.2 Exemple parameters (array) ######

    // parameters array avec Coverage
    $query = array(
        'api' => 'coverage',
    	'parameters' => array(
    		'region' => 'PaysDeLaLoire',
    		'path_filter' => 'lines/12',
    		'action' => 'route_schedules',
    		'parameters' => array (
    			'from_datetime' => 123312,
    			'duration' => 10
    		)
    	)
    );

###### 1.2.1.2.3 Exemple paramètres (string) ######

    // parameters string avec Coverage
    $query = array(
        'api' => 'coverage',
    	'parameters' => array(
    		'region' => 'centre',
    		'path_filter' => 'lines/12',
    		'action' => 'route_schedules',
    		'parameters' => '?from_datetime=123312&duration=10'
    	)
    );

##### 1.2.2 - Appel Navitia #####

L'appel Navitia se fait en trois petites étapes :
1. Instanciation de ServiceFacade
2. Ajout (set) de la configuration
3. Appel à l'api Navitia avec les paramètres de l'api


    $service = ServiceFacade::getInstance();
    $service->setConfiguration($config);
    $result = $service->call($query);

### 2 - Utilisation avancée ###

Des objets sont disponibles pour une utilisation avancée du NavitiaComponent.

#### 2.1 Exemples paramètres (object) pour coverage ####

    // parameters object avec Coverage
    $query = new \Navitia\Component\Request\CoverageRequest();
    $query->setRegion('centre');
    $query->setPathFilter('lines/12');
    $query->setAction('route_schedules');
    $actionParams = new \Navitia\Component\Request\Parameters\CoverageRouteSchedulesParameters();
    $actionParams->setFromDatetime(123312);
    $actionParams->setDuration(10);
    $query->setParameters($actionParams);

#### 2.2 Exemples paramètres (object) pour journeys ####

    // parameters object avec Journeys
    $query = new \Navitia\Component\Request\JourneysRequest();
    $actionParameters = new \Navitia\Component\Request\Parameters\JourneysParameters();
    $actionParameters->setFrom('stop_area:TAN:SA:COMM');
    $actionParameters->setTo('stop_area:SCF:SA:SAOCE87481051');
    $actionParameters->setDatetime('20130819T153000');
    $actionParameters->setDatetimeRepresents('departure');
    $query->setParameters($actionParameters);

#### 2.3 Appel ####
Les trois étapes de l'appel restent les mêmes pour l'utilisation simple et avancée.

Contributing
------------
1. Ramatoulaye Ndiaye - ramatoulaye.ndiaye@canaltp.fr
2. Johan Rouve - johan.rouve@canaltp.fr
