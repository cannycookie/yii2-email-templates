<?php
/**
 * @link https://github.com/cannycookie/yii2-email-templates
 * @copyright Copyright (c) 2017-2018 Yii Maker
 * @license BSD 3-Clause License
 */

namespace cannycookie\email\templates\tests\unit;

use Yii;
use cannycookie\email\templates\Module;
use cannycookie\email\templates\repositories\EmailTemplatesRepository;
use cannycookie\email\templates\repositories\EmailTemplatesRepositoryInterface;
use motion\i18n\LanguageProviderInterface;

/**
 * Test case for module.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class ModuleTest extends TestCase
{
    public function testInitService()
    {
        new Module('test', null, ['languageProvider' => []]);

        $this->assertInstanceOf(
            EmailTemplatesRepository::class,
            Yii::$container->get(EmailTemplatesRepositoryInterface::class)
        );
    }

    public function testInitLanguageProvider()
    {
        $this->expectException('yii\base\InvalidConfigException');
        new Module('test');
    }

    public function testInit()
    {
        new Module('test', null, ['languageProvider' => []]);

        $this->assertTrue(Yii::$container->has(EmailTemplatesRepositoryInterface::class));
        $this->assertTrue(Yii::$container->has(LanguageProviderInterface::class));
    }
}
