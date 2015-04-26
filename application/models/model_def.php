<?php

class Model_def extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function getNavigation($active = 'index')
    {
        $menu = $this->menuArray();
        $ret = '';
        foreach ($menu as $k => $sub) {
            $class = '';
            if ($k == $active)
                $class = 'active';
            $ret .= '<li><a href="' . $sub['href'] . '" class="' . $class . '">' . $sub['name'] . '</a></li>';
        }
        return $ret;
    }

    private function menuArray()
    {
        $arr = array(
            'index' => array(
                'href' => '/',
                'name' => 'Главная'
            ),
            'catalog' => array(
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
        );
        $data_auth = $this->dataAuth();
        if (isset($data_auth['email'])) {
            $arr['account'] = array(
                'href' => '/account',
                'name' => '<span style="color:white;">' . $data_auth['nickname'] . '</span>'
            );
            $arr['logout'] = array(
                'href' => '/logout',
                'name' => 'Выход'
            );
        }
        if (!isset($data_auth['email'])) {
            $arr['login'] = array(
                'href' => '/login',
                'name' => 'Вход'
            );
        }
        return $arr;
    }

    private function dataAuth()
    {
        $data = $this->session->all_userdata();
        return $data;
    }

    public function getAuth($arr)
    {

        $sql = "SELECT * FROM user WHERE email='{$arr['email']}' AND password='" . md5($arr['password']) . "'";
        $result = $this->db->query($sql);
        $arr_res = $result->result_array();
        if (isset($arr_res[0])) {
            $this->session->set_userdata($arr_res[0]);
        } else {
            if ($arr['type'] == 'local') {

                $this->session->set_flashdata('err_message', 'Неправильный логин или пароль');
                if (trim($this->input->post('captcha')) != $this->session->flashdata('captcha')) {
                    $this->session->set_flashdata('err_message', 'Неверно введен код с картинки');
                }
                return '/login';
            }
            if ($arr['type'] != 'local') {
                $this->addUser($arr);
                $this->session->set_userdata($arr);
            }
        }
        return '/';

    }

    public function addUser($data)
    {
        $sql = "INSERT INTO user (email, password, nickname) VALUES ('{$data['email']}','" . md5($data['password']) . "','" . $data['nickname'] . "')";
        $this->db->query($sql);
    }

}
