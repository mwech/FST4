<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('FST4', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\ConnectionWrapper',
  'dsn' => 'mysql:host=s567507373.online.de;dbname=FST4',
  'user' => 'FST4',
  'password' => 'adminfst4',
  'attributes' =>
  array (
    'ATTR_EMULATE_PREPARES' => false,
    'ATTR_TIMEOUT' => 30,
  ),
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('FST4');
$serviceContainer->setConnectionManager('FST4', $manager);
$serviceContainer->setDefaultDatasource('FST4');
$serviceContainer->setLoggerConfiguration('defaultLogger', array (
  'type' => 'stream',
  'path' => '/var/log/propel.log',
  'level' => 300,
));
$serviceContainer->setLoggerConfiguration('FST4', array (
  'type' => 'stream',
  'path' => '/var/log/propel_FST4.log',
));