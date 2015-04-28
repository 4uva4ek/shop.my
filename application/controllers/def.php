<?php
class Def extends CI_Controller
{

//put your code here
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_def', 'model');
        $this->load->helper('myurl');
        $this->load->library('view');
        $this->load->library('session');
    }

    public function index()
    {
        $this->view->title = 'Главная';
        $this->view->content('content/main');
    }

    public function catalog()
    {
        $this->view->addHistory('Каталог','/catalog');
        $this->view->title = 'Категории';
        $this->view->content('content/catalog');
    }

    public function login()
    {
        $this->view->addHistory('Вход','/login');
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

    public function registration()
    {
        $this->view->addHistory('Регистрация','/registration');
        if (!$this->input->post('go_register')) {
            $this->load->library('Ulogin');
            $this->ulogin->url = $this->router->config->config['base_url'] . 'def/get_auth';
            $this->view->title = 'Регистрация';
            $this->view->content('content/registration', array('ulogin' => $this->ulogin->get_html(), 'do' => 'show_html'));
        } else {
            if ($this->model->registration()) {
                $this->view->title = 'Регистрация завершена';
                $this->view->content('content/registration', array('do' => 'thanks'));
            } else {
                $this->load->library('Ulogin');
                $this->ulogin->url = $this->router->config->config['base_url'] . 'def/get_auth';
                $this->view->title = 'Регистрация';
                $this->view->content('content/registration', array('ulogin' => $this->ulogin->get_html(), 'do' => 'show_html','vals'=>$this->model->getVals(array('email','nickname'))));
            }
        }
    }
    public function account(){
        $this->view->addHistory('Профиль','/account');
        $this->view->title = 'Авторизация';
        $this->view->content('content/account', array('user' => $this->session->userdata('user')));
    }

}
