Установка
=========

## Получение с помощью Composer

Предпочтительный способ установки расширения через [composer](http://getcomposer.org/download/).

Для этого запустите

```
$ composer require cannycookie/yii2-email-templates
```

или добавьте

```
"cannycookie/yii2-email-templates": "~4.1"
````

в секцию `require` вашего `composer.json`.

## Настройка приложения

### Миграции

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

### Backend модуль

Для использования расширения, просто добавьте этот код в конфигурацию вашего приложения:

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

### Менеджер шаблонов

```php
'components' => [
    // ...
    'templateManager' => [
        'class' => \cannycookie\email\templates\components\TemplateManager::class,
    ],
]
```
