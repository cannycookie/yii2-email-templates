<?php
/**
 * @link https://github.com/cannycookie/yii2-email-templates
 * @copyright Copyright (c) 2017-2018 Yii Maker
 * @license BSD 3-Clause License
 */

namespace cannycookie\email\templates\tests\fixtures;

use yii\test\ActiveFixture;
use cannycookie\email\templates\entities\EmailTemplateTranslation;

/**
 * Fixure for [[EmailTemplateTranslation]] model.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class EmailTemplateTranslationFixture extends ActiveFixture
{
    /**
     * {@inheritdoc}
     */
    public $modelClass = EmailTemplateTranslation::class;
    /**
     * {@inheritdoc}
     */
    public $dataFile = '@data/email-template-translations.php';
    /**
     * {@inheritdoc}
     */
    public $depends = [
        EmailTemplateFixture::class,
    ];
}
