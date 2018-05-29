<?php

namespace app\components;

use yii\base\Widget;
use app\models\ArticleCat;
use Yii;
//use yii\base\Configurable;
//use yii\caching\CacheInterface;

class MenuMsWidget extends Widget {
    
//    параметр, передаваемый в виджет (вариант вида меню)
    public $tpl;
//    Все записи категорий из БД
    public $data;
//    Массив-дерево построенный функцией
    public $tree;
//    Готовый html код, в зависимости от выбранного шаблона
    public $menuHtml;
//    передаваемая параметром модель из формы (для селекта)
    public $model;


    public function init() {
        parent::init();
        if ( $this->tpl === null ) {
            $this->tpl = 'vert_menu';
        }
//        Получаем имя шаблона
        $this->tpl .= '.php';
    }

    public function run() {
        //если меню - то кешируем
        if($this->tpl == 'vert_menu.php') {
//                get cache
            $vert_menu = Yii::$app->cache->get('vert_menu');
            if ($vert_menu) return $vert_menu;
        }
//            get cache
//            $vert_menu = Yii::$app->cache->get('vert_menu');
//            $vert_menu = \yii\caching\FileCache::get('vert_menu');
        //$vert_menu = yii\caching\Cache::get('hhh');
//        if ($vert_menu) return $vert_menu;

        $this->data = ArticleCat::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        //если меню - то кешируем
        if($this->tpl == 'vert_menu.php') {
//            set cache
            Yii::$app->cache->set('vert_menu', $this->menuHtml, 5);
        }
//            debug($this->tree);
            
        return $this->menuHtml;
    }
    
/**
* Построение дерева
**/
    protected function getTree() {
	$tree = [];
	foreach ($this->data as $id=>&$node) {    
            if ( !$node['parent'] ) {
                    $tree[$id] = &$node;
            } else { 
                $this->data[$node['parent']]['childs'][$node['id']] = &$node;
            }
	}
	return $tree;
    }
    
/**
* Дерево в строку HTML
 * $tab - будет рекурсивно наполняться разделителями для выделения вложенности (например в select - '-')
**/
    protected function getMenuHtml($tree, $tab = '') {
        $str = '';
        foreach($tree as $category){
                $str .= $this->catToTemplate($category, $tab);
        }
        return $str;
    }
/**
* Шаблон вывода категорий
 * функция построения htlm кода
**/    
    protected function catToTemplate($category, $tab){
	ob_start();
	include __DIR__ . '/menu_tpl/' . $this->tpl;
	return ob_get_clean();
    }
    
    
}

