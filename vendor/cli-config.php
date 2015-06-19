<?php

require 'autoload.php';
require '../src/config/parameters.php';
use Doctrine\ORM\Tools\Setup;

$path = array('../src/orm/entities');
$devMode = true;

$config = Setup::createAnnotationMetadataConfiguration($path, $devMode);

$em = \Doctrine\ORM\EntityManager::create(DATABASE_SETTINGS, $config);

$helpers = new Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));