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
class Admin extends CI_Controller {

//put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('model_admin','admin');
        $this->load->model('model_def', 'model');
        $this->load->helper('myurl');
        $this->load->library('view');
        $this->user = $this->session->userdata('user');
        if ($this->user['access'] != 2)
        {
            $this->view->title='Страница не найдена';
            $this->view->content('content/404');
        }
    }
    
    public function index(){
        $this->view->title='Главная';
        //$this->view->layout_var('template/header','header',array());
        $this->view->content('content/main');
    }
}
