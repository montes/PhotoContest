<?php



require_once(SMF_FOLDER . 'Settings.php');

//TODO: include lightbox js and css dependencies
$headers    = '<script type="text/javascript" src="https://www.google.com/jsapi?key=ABQIAAAA4N1cVP8wk_WE1At_kNm57RTJ4bHgoDQQq-6NpuDOPLgwe1GIThRH_hiPQW5HYToH4hz2JfNj41fQAA"></script>';
$headers   .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>';

$context['html_headers'] = $headers;

//Load SMF's SSI
$ssi_layers = array('html', 'body'); //Shows header & menu
require_once(SMF_FOLDER . 'SSI.php');

if (!empty($db_options['persist']))
	$connection = @mysql_pconnect($db_server, $db_user, $db_passwd);
else
	$connection = @mysql_connect($db_server, $db_user, $db_passwd);

// Something's wrong, show an error if its fatal (which we assume it is)
if (!$connection) {
    if (!empty($db_options['non_fatal'])) {
        return null;
    } else {
        db_fatal_error();
    }
}

// Select the database, unless told not to
mysql_select_db($db_name, $connection);

global $smcFunc, $context, $user_info;

$context['smcFunc'] = $smcFunc;
$context['user_info'] = $user_info;