<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "site".
 *
 * @property int $id
 * @property string $title
 * @property string $meta_description mata-description
 * @property string $meta_keywords ключевые слова
 * @property string $text
 * @property string $date_add
 */
class Site extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'meta_description', 'meta_keywords', 'text', 'date_add'], 'required'],
            [['meta_description', 'text'], 'string'],
            [['title', 'meta_keywords'], 'string', 'max' => 255],
            [['date_add'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'meta_description' => 'Мета-описание',
            'meta_keywords' => 'Ключевые слова',
            'text' => 'Текст',
            'date_add' => 'Дата добавления',
        ];
    }
}
