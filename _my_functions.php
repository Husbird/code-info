<?php

function clearUrlStr($str) {
//    $str = str_replace( ' ' , '_' , trim($str) );
    $converter = array (

	' ' => '_', '-' => '_', '–' => '_', '(' => '', ')' => '', '.' => '_', 

	',' => '', '<' => '', '>' => '', '/' => '', '|' => '', '\\' => '',
	
	'_' => '_', '&' => '_and_', '"' => '', ':' => '', '!' => '','?' => '',

	'$' => '','^' => '',"'" => '','«' => '','»' =>'','<wbr>' =>'', '`' => '',

    '%' => '', '#' => '', '&quot;' => '');
	 
		return mb_strtolower( strtr($str, $converter) );	
    
}

function debug($someData) {
	echo '<pre>' . print_r($someData, true) . '</pre>';
}

//Проверяем, есть ли дочерние категории в категории с id - $catId
function findChildrens($arrayFull, $catId) {
 
//    $arr = [];
     $childrensCount = 0;
    for ($i = 0; $i <= count($arrayFull); $i++) {
        
        if ( isset($arrayFull[$i]['parent']) && $catId == $arrayFull[$i]['parent'] ) {
            //debug($catId);//die;
            $childrensCount++;
        }
    }
    //die;
    if ($childrensCount != 0) {
        return $childrensCount;
    } else {
        return 0;
    }
//    debug($arr);
}

function findParent($parent_id, $categoryArray) {
    //$parentCount = 0;
    $parent = [];
    foreach ($categoryArray as $k => $val) {
        if ($val['id'] == $parent_id) {
            
            $parent = array('id' => $val['id'] ,'title' => $val['title'], 'parent' => $val['parent']);
            
            return $parent;
        }
    }
}
// Получить строку из массива - дерева
function getStr($arr, $str = '') {
    if ($str === '') {
        $str = $arr['title'];
    }
    
    if ( is_array($arr['parent']) ) {
        $str = $str."->".$arr['parent']['title'];
        getStr($arr['parent'], $str);
        return getStr($arr['parent'], $str);
    } else {
        return $str;
    }
}

//    Получаем массив-дерево конечных категорий (у которых нет Child-дов)
//      $categoryArray - массив со всеми категориями из БД
//        полученный так: $categoryArray = Article_cat::find()->asArray()->all();
function getMainCategoriesTree($categoryArray) {
    foreach($categoryArray as $k => $v) {

        $childrensSum = findChildrens($categoryArray, $v['id']);
        
        // если детей нет - то значит основная категория - запоминаем её в $mainArr
        if ($childrensSum === 0) {
            $mainArr[$v['id']]['title'] = $v['title'];
            $mainArr[$v['id']]['parent'] = findParent($v['parent'], $categoryArray);
            //$mainArr[$v['id']]['parent']['parent'] = findParent($mainArr[$v['id']]['parent']['id'], $categoryArray);
            if ( isset($mainArr[$v['id']]['parent']['parent']) && ($mainArr[$v['id']]['parent']['parent'] != 0) ) {
                $mainArr[$v['id']]['parent']['parent'] = findParent($mainArr[$v['id']]['parent']['parent'], $categoryArray);
            }
            
            if ( isset($mainArr[$v['id']]['parent']['parent']['parent']) && ($mainArr[$v['id']]['parent']['parent']['parent'] != 0) ) {
                $mainArr[$v['id']]['parent']['parent']['parent'] = findParent($mainArr[$v['id']]['parent']['parent']['parent'], $categoryArray);
            }      
        }
    }
    
    return $mainArr; // массив - дерево конечных категорий
}

// Получаем массив с id конечных категорий и строкой - описанием их иерархии
// $categoriesTree - массив-дерево конечных категорий
function getCategoryList($categoriesTree) {
    foreach ($categoriesTree as $key => $val) {
        $arr[$key] = getStr($val);
    }
    return $arr;
}













//function findParent($arrayFull, $catId, $str = '') {
//
//    // ищу дочернюю категорию от $catId
//   foreach ($arrayFull as $k => $val) {
//       ;
//       if ($val['id'] == $catId) {
//           $parentTitle = $val['title'];
//
//
//           if ($str == '')
//            $str = "Родитель: ".$parentTitle;
//       }
//       if ( $val['parent'] == $catId ) {
//
//           $parentId = $val['id'];
//           $str = $str.'->'.$val['title']." (id:)".$val['id'];
//
//           findParent($arrayFull, $parentId, $str);
//
//           debug($str);
//
//        }
//    }
//}
        
    function getTree($arrayFull) {
        $tree = [];
        foreach ($arrayFull as $id=>&$node) {    
            if ( !$node['parent'] ) {
                    $tree[$id] = &$node;
            } else { 
                $arrayFull[$node['parent']]['childs'][$node['id']] = &$node;
            }
        }
        return $tree;
    }
?>
