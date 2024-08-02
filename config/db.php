<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => sprintf("mysql:host=%s;dbname=%s",
      getenv('db_host'), getenv("db_name")),
    'username' => sprintf("%s", getenv('db_user')),
    'password' => sprintf("%s", getenv('db_pass')),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
