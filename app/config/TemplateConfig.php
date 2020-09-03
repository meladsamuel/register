<?php
return [
      'template' => [
            'header'          => TEMPLATE_PATH . 'header.php',
            'nav'             => TEMPLATE_PATH . 'nav.php',
            'containerStart'  => TEMPLATE_PATH . 'viewBodyStart.php',
            ':view'           => 'actionView',
            'containerEnd'    => TEMPLATE_PATH . 'viewBodyEnd.php',
      ],
      'header_resources' => [
            'main'            => CSS . 'skeleton.css',
            'rtl'             => $_SESSION['lang'] == 'ar' ? CSS . 'rtl.css' : null,
            'fontAwesome'     => CSS . 'all.min.css',
      ],
      'footer_resources' => [
            'main'      => JS.'main.js'
      ]
];