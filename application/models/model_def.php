<?php

class Model_def extends CI_Model {

    function __construct() {
	parent::__construct();
	$this->load->database();
	$this->load->library('session');
    }
    
    public function getNavigation($active='index'){
        $menu = $this->menuArray();
	$ret = '';
	foreach ($menu as $k => $sub) {
	    $class = '';
	    if ($k == $active)
		$class = 'active';
	    $ret.= '<li><a href="' . $sub['href'] . '" class="'.$class.'">' . $sub['name'] . '</a></li>';
	}
	return $ret;
    }
    private function menuArray() {
	$arr = array(
            'index' => array(
		'href' => '/',
		'name' => 'Главная'
	    ),
            'category' => array(
		'href' => '/catalog',
		'name' => 'Каталог'
	    ),
	    'news' => array(
		'href' => '/hot',
		'name' => 'Новинки'
	    ),
	    'users' => array(
		'href' => '/about',
		'name' => 'О нас'
	    ),
            'authoriz' => array(
		'href' => '/authoriz',
		'name' => 'Вход'
	    ),
	);
	return $arr;
    }

}
