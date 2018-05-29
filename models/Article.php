<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $description описание статьи
 * @property string $text
 * @property string $date_add
 * @property string $date_edit
 * @property string $edit_info
 * @property string $author_source
 * @property string $source_link
 * @property int $category_id
 * @property string $keywords
 * @property int $views
 * @property string $access_level уровень доступа
 */

class Article extends ActiveRecord {
    
//        указываем имя таблицы, если оно не соответствует имени модели:
	public static function tableName() {
		return 'article';
	}
        
//        связь: у множества категорий - одна статья
            public function getArticleCategory() {
            return $this->hasOne(ArticleCat::className(), ['id' => 'category_id']);
        }
        
    /**
     * @inheritdoc
     */
//     Правила валидации
    public function rules()
    {
        return [
//            [['title', 'description', 'text', 'date_add', 'date_edit', 'edit_info', 'author_source', 'source_link', 'category_id', 'keywords', 'views', 'access_level'], 'required'],
//            [['title', 'description', 'text', 'date_add', 'date_edit', 'edit_info', 'author_source', 'source_link', 'category_id', 'keywords', 'views', 'access_level'], 'required'],
            [['description', 'text'], 'string'],
            [['category_id', 'views'], 'integer'],
            [['title', 'author_source', 'source_link', 'keywords'], 'string', 'max' => 255],
            [['access_level'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ статьи',
            'title' => 'Название статьи',
            'description' => 'Описание',
            'text' => 'Текст',
            'date_add' => 'Дата публикации',
            'date_edit' => 'Дата редактирования',
            'edit_info' => 'Редактировал',
            'author_source' => 'Автор\источник',
            'source_link' => 'Ссылка на источник',
            'category_id' => 'ID категории',
            'keywords' => 'Ключевые слова',
            'views' => 'Количество просмотров',
            'access_level' => 'Уровень доступа',
        ];
    }
    
    public function create_dir($id) {
//        die('----');
        // Желаемая структура папок
        $structure = './upload/global/article/'.$id.'/';

        // Для создания вложенной структуры необходимо указать параметр
        // $recursive в mkdir().

        if ( !mkdir($structure, 0777, true) ) {
            return false;
//            die('Не удалось создать директории...');
        }
        
        return true;
    }
    
    public function drop_dir($dir_path) {
        // Функция glob() ищет все пути, совпадающие с шаблоном
        if ($objs = glob($dir_path."/*")) {
            foreach($objs as $obj) {
              is_dir($obj) ? $this->drop_dir($obj) : unlink($obj);
            }
        }
        $rm = rmdir($dir_path);
        return $rm;
    }
}