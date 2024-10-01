<?php
define('_DIR_ROOT', __DIR__);
const _INCODE = true; //Ngăn chặn hành vi truy cập trực tiếp vào file
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Xử lý http root
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') :
    $webRoot = 'https://' . $_SERVER['HTTP_HOST'];
else :
    $webRoot = 'http://' . $_SERVER['HTTP_HOST'];
endif;

$dirRoot = str_replace('\\', '/', _DIR_ROOT);

$documentRoot = $_SERVER['DOCUMENT_ROOT'];

$folder = str_replace(strtolower($documentRoot), '', strtolower($dirRoot));

$webRoot = $webRoot . $folder;

define('_WEB_ROOT', $webRoot);


/* 
    Tự động load configs
*/
// scandir: trả về một mảng chứa tên của các tệp và thư mục trong thư mục đã chỉ định.
$configsDir = scandir('configs');

if (!empty($configsDir)) :
    foreach ($configsDir as $item) :
        if ($item != '.' && $item != '..' && file_exists('configs/' . $item)) :
            require_once 'configs/' . $item;
        endif;
    endforeach;
endif;

// Load Paginate
require_once 'core/Paginate.php';

// Load Service Provider Class
require_once 'core/ServiceProvider.php';

// Load View
require_once 'core/View.php';


// Load PHP Mailer
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';
require_once 'phpmailer/Exception.php';

require_once 'core/Route.php';

// Kiểm tra config của DB và load vào
if (!empty($config['database'])) :
    $dbConfig = $config['database'];

    if (!empty($dbConfig)) :
        require_once 'core/Connection.php';
        require_once 'core/QueryBuilder.php';
        require_once 'core/Database.php';
        require_once 'core/DB.php';
    endif;
endif;


require_once 'app/App.php';
require_once 'core/Session.php';

//Load core helpers
require_once 'core/Helper.php';

//Load all heplers
$allHelpers = scandir('app/helpers');
if (!empty($allHelpers)) {
    foreach ($allHelpers as $item) {
        if ($item != '.' && $item != '..' && file_exists('app/helpers/' . $item)) {
            require_once 'app/helpers/' . $item;
        }
    }
}


require_once 'core/Mailer.php';
require_once 'core/Model.php';
require_once 'core/Controller.php';
require_once 'core/Request.php';
require_once 'core/Response.php';