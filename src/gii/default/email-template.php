<?php

/**
 * View file for gii generator.
 *
 * @var \cannycookie\email\templates\gii\Generator $generator
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.1
 */

$className = $generator->migrationName;
echo "<?php\n";
?>

use yii\db\Migration;
use cannycookie\email\templates\entities\EmailTemplate;

/**
 * Handles creating of email template.
 *
 * Generated by `cannycookie/yii2-email-templates`.
 * @see <?= \cannycookie\email\templates\Module::getRepoUrl() ?>

 */
class <?= $className ?> extends Migration
{
    /**
     * Migration table name.
     *
     * @var string
     */
    public $tableName = '{{%email_template}}';
    /**
     * Migration table name.
     *
     * @var string
     */
    public $translationTableName = '{{%email_template_translation}}';


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert($this->tableName, [
            'key' => '<?= $generator->key ?>',
        ]);

        $templateId = EmailTemplate::find()
            ->select('id')
            ->where(['key' => '<?= $generator->key ?>'])
            ->scalar();

<?php if (Yii::$app->getModule('email-templates')): ?>
        $this->batchInsert(
            $this->translationTableName,
            [
                'templateId',
                'language',
                'subject',
                'body',
                'hint',
            ],
            [
            <?php foreach(\motion\i18n\helpers\LanguageHelper::getInstance()->getLocales() as $language): ?>    [
                    'templateId'    => $templateId,
                    'language'      => '<?= $language ?>',
                    'subject'       => '<?= $generator->subject ?>',
                    'body'          => '<?= $generator->body ?>',
                    'hint'          => '<?= $generator->hint ?>',
                ],
            <?php endforeach; ?>]
        );
<?php else: ?>
        $this->insert($this->translationTableName, [
            'templateId'    => $templateId,
            'language'      => Yii::$app->language,
            'subject'       => '<?= $generator->subject ?>',
            'body'          => '<?= $generator->body ?>',
            'hint'          => '<?= $generator->hint ?>',
        ]);
<?php endif; ?>
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete($this->tableName, '[[key]] = :key', [
            ':key' => '<?= $generator->key ?>',
        ]);
    }
}
