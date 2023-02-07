<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 3/8/2019
 * Time: 1:53 PM
 */

class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
            $ci->lang->load('admin',$siteLang);
        } else {
            $ci->lang->load('admin','turkish');
        }
    }
}