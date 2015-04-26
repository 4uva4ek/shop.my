<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of default
 *
 * @author Admin
 */
class Def extends CI_Controller {

//put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('model_def','model');
        $this->load->helper('myurl');
        $this->load->library('view');
    }
    
    public function index(){
        $this->view->title='Главная';
        //$this->view->layout_var('template/header','header',array());
        $this->view->content('content/main');
    }
    public function cat(){
        $this->view->title='Категории';
        $this->view->content('content/categories');
    }

}
