<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| Hooks memungkinkan kita untuk menjalankan kode pada titik tertentu
| dalam siklus eksekusi CodeIgniter.
|
| Untuk mengaktifkan hooks, set $config['enable_hooks'] = TRUE di config.php
*/

/**
 * Security Headers Hook
 * 
 * Dijalankan setelah controller constructor untuk menambahkan
 * HTTP security headers ke setiap response.
 */
$hook['post_controller_constructor'][] = array(
    'class'    => 'SecurityHeaders',
    'function' => 'set_headers',
    'filename' => 'SecurityHeaders.php',
    'filepath' => 'hooks'
);
