<?php
/**
 * @link https://github.com/yiimaker/yii2-email-templates
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\email\templates\services;

/**
 * Interface for email templates services
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
interface ServiceInterface
{
    /**
     * Returns model object
     *
     * @return mixed
     */
    public function getModel();

    /**
     * Returns translation model object
     *
     * @param integer|null $modelId Model ID
     * @param string|null $language Model language
     * @return mixed
     */
    public function getTranslationModel($modelId = null, $language = null);

    /**
     * Create model with translation
     *
     * @param array $data Array with data for models
     * @return mixed
     */
    public function create($data);

    /**
     * Updates models data
     *
     * @param mixed $model Model object
     * @param mixed $translation Translation model object
     * @param array $data Array with data for models
     * @return mixed
     */
    public function update($model, $translation, $data);
}