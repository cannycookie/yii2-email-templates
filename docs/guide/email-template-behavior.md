Email template behavior
=======================

You can use email template behaviour for appending the email template to
your ActiveRecord model.

## One template

### Configuration

```php
// bootstrap.php

\Yii::$container->set(
    \cannycookie\email\templates\repositories\EmailTemplatesRepositoryInterface::class,
    \cannycookie\email\templates\repositories\EmailTemplatesRepository::class
);

// or config/main.php
`container` => [
    'singletons' => [
        // ...
        \cannycookie\email\templates\repositories\EmailTemplatesRepositoryInterface::class =>
            \cannycookie\email\templates\repositories\EmailTemplatesRepository::class,
    ],
],
```

```php
// ActiveRecord model

public function behaviours()
{
    return [
        // ...
        'emailTemplate' => \cannycookie\email\templates\behaviors\EmailTemplateBehavior::class,
    ];
}
```

### Using

> Your model must contain the language attribute. You can specify this attribute name
> in `languageAttribute` configuration property. This property is set to `language` by default.

```php
$model = new ActiveRecordModel();

$model->letterSubject = 'Welcome!';
$model->letterBody = 'Hello, {username}! Welcome to ...';
$model->emailTemplateHint = 'In "body" you can use {username} placeholder';

$model->save();
```

## Multiple templates in one model

### Configuration

```php
// ActiveRecord model

public function behaviours()
{
    return [
        // ...
        'emailTemplateWelcome' => [
            'class' => \cannycookie\email\templates\behaviors\EmailTemplateBehavior::class,
            'key' => 'welcome', // unique template key for current model
        ],
        'emailTemplateBye' => [
            'class' => \cannycookie\email\templates\behaviors\EmailTemplateBehavior::class,
            'key' => 'bue', // unique template key for current model
        ],
    ];
}
```

### Using

1. Create getters and setters
```php
class ActiveRecordModel extends \yii\db\ActiveRecord
{
    public function behaviours() {...}
    
    /* Email template welcome */
    
    public function getWelcomeLetterSubject()
    {
        return $this->getBehaviour('emailTemplateWelcome')->letterSubject;
    }
    
    public function setWelcomeLetterSubject($subject)
    {
        $this->getBehaviour('emailTemplateWelcome')->letterSubject = $subject;
    }
    
    // getters and setters for `letterBody` and `emailTemplateHint`
    
    /* Email template bye */
    
    public function getByeLetterSubject()
    {
        return $this->getBehaviour('emailTemplateBye')->letterSubject;
    }
    
    public function setByeLetterSubject($subject)
    {
        $this->getBehaviour('emailTemplateBye')->letterSubject = $subject;
    }
    
    // getters and setters for `letterBody` and `emailTemplateHint`
}
```

2. Using
```php
$model = new ActiveRecordModel();

$model->welcomeLetterSubject = 'Hello, {username}!';
$model->welcomeLetterBody = 'Dear, {username} ...';

$model->byeLetterSubject = 'Bye, {username} :(';
$model->byeLetterBody = 'Don\'t leave our {site-name} ;(';

$model->save();
```
