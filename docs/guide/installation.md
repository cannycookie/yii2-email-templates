Installation
============

## Getting Composer package

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ composer require cannycookie/yii2-email-templates
```

or add

```
"cannycookie/yii2-email-templates": "~4.1"
````

to the `require` section of your `composer.json`.

## Configuring application

### Migrations

```php
// console/config/main.php

'controllerMap' => [
    'migrate' => [
        'class' => yii\console\controllers\MigrateController::class,
        'migrationNamespaces' => [
           // ...
           'cannycookie\email\templates\migrations',
        ],
    ],
],
```

### Backend module

To use this extension, simply add the following code in your application configuration:

```php
'modules' => [
    // ...
    'email-templates' => [
        'class' => \cannycookie\email\templates\Module::class,
        'languageProvider' => [
            'class' => \motion\i18n\ConfigLanguageProvider::class,
            'languages' => [
                [
                    'locale' => 'en',
                    'label' => 'English',
                ],
                // ...
            ],
            'defaultLanguage' => [
                'locale' => 'en',
                'label' => 'English',
            ],
        ],
    ],
]
```

### Template manager

```php
'components' => [
    // ...
    'templateManager' => [
        'class' => \cannycookie\email\templates\components\TemplateManager::class,
    ],
]
```