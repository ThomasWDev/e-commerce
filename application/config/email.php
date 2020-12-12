<?php 
    $CI =& get_instance();
    $CI->load->model('Admin_model');
    $settings = $CI->Admin_model->get_payment_settings();
    /* Email config */
    $config = array(
        'protocol'     =>  'smtp',
        'smtp_host'    =>  'smtp.sendgrid.net',
        'smtp_user'    =>  'apikey',
        'smtp_pass'    =>   $settings['sendgrid_key'],
        'smtp_port'    =>  '587',
        'smtp_timeout' =>  '7',
        'charset'      =>  'iso-8859-1',
        'newline'      =>  "\r\n",
        'mailtype'     =>  'html',
        'validation'   =>  TRUE,
        'wordwrap'     =>  TRUE
    );


