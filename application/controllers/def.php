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
class Def extends CI_Controller
{

//put your code here
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_def', 'model');
        $this->load->helper('myurl');
        $this->load->library('view');
    }

    public function index()
    {
        $this->view->title = 'Главная';
        //$this->view->layout_var('template/header','header',array());
        $this->view->content('content/main');
    }

    public function catalog()
    {
        $this->view->title = 'Категории';
        $this->view->content('content/catalog');
    }

    public function login()
    {
        $this->load->library('Ulogin');
        $this->ulogin->url = $this->router->config->config['base_url'] . 'def/get_auth';
        $this->view->title = 'Авторизация';
        $this->view->content('content/login', array('ulogin' => $this->ulogin->get_html()));
    }

    public function get_auth()
    {
        $this->load->library('Ulogin');
        $data = $this->ulogin->userdata();
        if (!$data) {
            $arr['email'] = $this->input->post('email');
            $arr['password'] = $this->input->post('password');
            $arr['type'] = 'local';
        }
        if ($data) {
            $arr['email'] = $data['email'];
            $arr['password'] = $data['uid'];
            $arr['type'] = $data['network'];
            $arr['nickname'] = $data['first_name'] . ' ' . $data['last_name'];
        }
        redir($this->model->getAuth($arr));
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redir('/');
    }

    public function captcha()
    {
        $this->load->helper('captcha');
        $vals = array(
            'img_width' => 152,            // ширина изображения (int)
            'img_height' => 30,            // высота изображения (int)
            'random_str_length' => 4,        // длина случайной строки (int)
            'border' => FALSE,
        );

        $this->session->set_flashdata('captcha', create_captcha_stream($vals));
    }

}
