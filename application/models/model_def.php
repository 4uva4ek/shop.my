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
        if (isset($data['user'])) {
            return $data['user'];
        } else {
            return false;
        }
    }

    public function getAuth($arr)
    {
        if ((trim($this->input->post('captcha')) != $this->session->flashdata('captcha')) && $arr['type'] == 'local') {
            $this->session->set_flashdata('err_message', 'Неверно введен код с картинки');
            return '/login';
        }
        $sql = "SELECT * FROM user WHERE email='{$arr['email']}' AND password='" . md5($arr['password']) . "'";
        $result = $this->db->query($sql);
        $arr_res = $result->result_array();
        if (isset($arr_res[0])) {
            $this->session->set_userdata(array('user' => $arr_res[0]));
        } else {
            if ($arr['type'] == 'local') {
                $this->session->set_flashdata('err_message', 'Неправильный логин или пароль');
                return '/login';
            }
            if ($arr['type'] != 'local') {
                $this->addUser($arr);
                $this->session->set_userdata(array('user' => $arr));
            }
        }
        return '/';

    }

    public function addUser($data)
    {
        $sql = "INSERT INTO user (email, password, nickname) VALUES ('{$data['email']}','" . md5($data['password']) . "','" . $data['nickname'] . "')";
        $this->db->query($sql);
    }

    public function registration()
    {
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $data['nickname'] = $this->input->post('nickname');
        $emails = $this->db->get('user');
        $password2 = $this->input->post('password2');
        $mess = false;
        if (trim($this->input->post('captcha')) != $this->session->flashdata('captcha')) {
            $mess .= 'Неверно введен код с картинки<br/>';
        }
        if ($data['password'] != $password2) {
            $mess .= 'Пароли не совпадают<br/>';
        }
        foreach ($emails->result_array() as $email) {
            if ($data['email'] == $email) {
                $mess .= 'Указанная электронная почта уже существует<br/>';
            }
        }
        if ($mess) {
            $this->session->set_flashdata('err_message', $mess);
            return false;
        }
        $this->addUser($data);
        $this->session->set_flashdata('ok_message', 'Регистрация завершена успешно');
        return true;

    }

    public function getVals($vals)
    {
        if (is_array($vals)) {
            foreach ($vals as $val) {
                $out[$val] = $this->input->post($val);
            }
            return $out;
        } else return false;
    }

    public function showAdminPanel()
    {
        $arr_menu = array(
            array(
                'name' => 'Добавить категорию',
                'href' => 'admin/add_category'
            ),
            array(
                'name' => 'Добавить товар',
                'href' => 'admin/add_tovar'
            ),
            array(
                'name' => 'Заказы',
                'href' => 'admin/order'
            ),
        );
        $str=array();
        foreach ($arr_menu as $arr)
        {
            $str[]='<a href="'.$arr['href'].'">'.$arr['name'].'</a>';
        }
        return implode('<br/>',$str);
    }

}
