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
    public function authoriz()
    {
        $this->load->library('Ulogin');
        $this->ulogin->url = $this->CI->router->config['config']['base_url'].'/def/get_auth';
        var_dump($this->CI->router->config);
        $this->view->title='Авторизация';
        $data = $this->ulogin->userdata();
        $this->view->content('content/authoriz',array('ulogin'=>$this->ulogin->get_html())); 
    }

}
