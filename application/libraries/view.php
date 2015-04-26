<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class View {

    public function __construct() {
        $this->layout_vars = array();
        $this->content_vars = array();
        $this->head_vars = array();
        $this->header_vars = array();
        $this->footer_vars = array();
        $this->nav_vars = array();
        $this->layout = 'layout';
        $this->head = 'template/head';
        $this->header = 'template/header';
        $this->footer = 'template/footer';
        $this->navigation = 'template/navigation';
        $this->title = '';
        $this->description = '';
        $this->keywords = '';
        $this->copyright = '© 2012 Santana Demo Store. All Rights Reserved. Design &amp; Develop by <a href="http://www.magicdesignlabs.com/">MagicDesignLabs</a>';
        $this->CI = &get_instance();
    }

    function setLayout($template) {
        $this->layout = $template;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function set($varName, $value) {
        $this->vars[$varName] = $value;
    }

    function setGlobal($varName, $value) {
        $this->layoutVars[$varName] = $value;
    }

    /**
     * Fetch template and return it.
     *
     * @param String $template
     */
    function fetch($template) {
        $content = $this->CI->load->view($template, $this->content_vars, true);

        $this->layout_vars['content'] = $content;
        $this->layout_vars['head'] = $this->getHead();
        $this->layout_vars['header'] = $this->getHeader();
        $this->layout_vars['navigation'] = $this->getNavigation();
        $this->layout_vars['footer'] = $this->getFooter();

        return $this->CI->load->view($this->layout, $this->layout_vars, true);
    }

    function getHead() {
        $this->head_vars['description'] = $this->description;
        $this->head_vars['keywords'] = $this->keywords;
        $this->head_vars['title'] = $this->title;
        $head = $this->CI->load->view($this->head, $this->head_vars, true);
        return $head;
    }

    function getHeader() {
        $this->header_vars['description'] = $this->description;
        $this->header_vars['keywords'] = $this->keywords;
        $head = $this->CI->load->view($this->header, $this->header_vars, true);
        return $head;
    }

    function getNavigation() {
        $this->CI->load->model('model_def','model');
        $this->nav_vars['nav'] = $this->CI->model->getNavigation($this->CI->router->method);
        $nav = $this->CI->load->view($this->navigation, $this->nav_vars, true);
        return $nav;
    }

    function getFooter() {
        $this->footer_vars['copyright'] = $this->copyright;
        $footer = $this->CI->load->view($this->footer, $this->footer_vars, true);
        return $footer;
    }

    /**
     * Renders template to $content.
     *
     * @param String $template
     */
    function content($template, $arr = array()) {
        if (is_array($arr)) {
            foreach ($arr as $key => $val) {
                $this->content_vars[$key] = $val;
            }
        }
        echo $this->fetch($template);
    }

    function layout_var($template, $name, $array) {
        $this->layout_vars[$name] = $this->CI->load->view($template, $array, true);
    }

}
