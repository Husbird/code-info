<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article_cat".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property int $parent
 * @property string $date_add
 * @property int $views
 * @property string $access_level уровень доступа
 */

class ArticleCat extends ActiveRecord {
    
//        указываем имя таблицы, если оно не соответствует имени модели:
    public static function tableName() {
            return 'article_cat';
    }

//        связь: у одной категории - множество статей
    public function getArticleCategories() {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }
    
    // здесь ссылаемся на эту же модель (вытягиваем название категории соответствующее текущему id)
    public function getCategory() {
        return $this->hasOne(ArticleCat::className(), ['id' => 'parent']);

    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'keywords', 'parent', 'date_add', 'views', 'access_level'], 'required'],
            [['description'], 'string'],
            [['parent', 'views'], 'integer'],
            [['title', 'keywords'], 'string', 'max' => 255],
            [['date_add', 'access_level'], 'string', 'max' => 50],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ категории',
            'title' => 'Название категории',
//            'parent' => 'Родительская категория',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
            'parent' => 'Родительская категория',
            'date_add' => 'Дата создания',
            'views' => 'Кол-во просмотров',
            'access_level' => 'Уровень доступа',
        ];
    }
}

