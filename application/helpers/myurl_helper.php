<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function redir($url){
    echo '<script>location.href="'.$url.'"</script>';
}