<?php
/**
 * @link https://github.com/cannycookie/yii2-email-templates
 * @copyright Copyright (c) 2017-2018 Yii Maker
 * @license BSD 3-Clause License
 */

namespace cannycookie\email\templates\tests\unit\components;

use Yii;
use cannycookie\email\templates\entities\EmailTemplateTranslation;
use cannycookie\email\templates\models\EmailTemplate as EmailTemplateModel;
use cannycookie\email\templates\tests\fixtures\EmailTemplateTranslationFixture;
use cannycookie\email\templates\tests\unit\DbTestCase;

/**
 * Test case for template manager.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class TemplateManagerTest extends DbTestCase
{
    /**
     * @var \cannycookie\email\templates\components\TemplateManager
     */
    private $manager;
    /**
     * @var string
     */
    private $key = 'test-template';


    /**
     * {@inheritdoc}
     */
    public function fixtures()
    {
        return [
            'template' => EmailTemplateTranslationFixture::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function _before()
    {
        parent::_before();
        $this->manager = Yii::$app->get('templateManager');
    }

    public function testGetTemplate()
    {
        $expected = EmailTemplateModel::buildFromEntity(
            EmailTemplateTranslation::findOne(['language' => 'en'])
        );
        $actual = $this->manager->getTemplate($this->key);

        $this->assertEquals($expected, $actual);

        $expected = EmailTemplateModel::buildFromEntity(
            EmailTemplateTranslation::findOne(['language' => 'ru'])
        );
        $actual = $this->manager->getTemplate($this->key, 'ru');

        $this->assertEquals($expected, $actual);

        $expected = new EmailTemplateModel('subject', 'body');
        $actual = $this->manager->getTemplate($this->key, 'fr', $expected);

        $this->assertSame($expected, $actual);
    }

    public function testGetAllTemplates()
    {
        $expected = EmailTemplateModel::buildMultiply(
            EmailTemplateTranslation::findAll(['templateId' => 1])
        );
        $actual = $this->manager->getAllTemplates($this->key);

        $this->assertEquals($expected, $actual);

        $expected = [
            new EmailTemplateModel('subject-1', 'body-1'),
            new EmailTemplateModel('subject-2', 'body-2'),
        ];
        $actual = $this->manager->getAllTemplates('not-exists', $expected);

        $this->assertSame($expected, $actual);
    }

    public function testHasTemplate()
    {
        $actual = $this->manager->hasTemplate($this->key);
        $this->assertTrue($actual);

        $actual = $this->manager->hasTemplate('not-exists');
        $this->assertFalse($actual);
    }
}
