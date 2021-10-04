#!/bin/sh

./docker/wait-for-it.sh -t 0 mock_navitia:1080

./vendor/bin/phpunit --log-junit /srv/navitiacomponent/Tests/junit.xml
