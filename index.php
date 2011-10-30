<?php
/**
 * 
 */

//Define SMF's folder and load SSI
define('SMF_FOLDER', '/Users/montes/www/furgovw/');
require_once(dirname(__FILE__) . '/loadSMFSSI.php');

//Pimple Container (http://pimple.sensiolabs.org/)
$c                  = new Pimple();

//SMF's globals
$c['smcFunc']       = $smcFunc;
$c['context']       = $context;
$c['user_info']     = $user_info;

$c['db']            = $c->share(function ($c) {
    return new PhotoContest\SMFDb($c['smcFunc']);
});

$c['options']       = function ($c) {
    return \PhotoContest\PhotoContest::loadConfig($c['db']);
};

$c['user']          = $c->share(function ($c) {
    return new \PhotoContest\SMFUser($c['context'], $c['user_info'], $c['db'], $c['options']);
});

$c['photos']        = $c->share(function ($c) {
    return new \PhotoContest\Photos();
});

$c['photoContest']  = $c->share(function ($c) {
    return new \PhotoContest\PhotoContest($c['db'], $c['user'], $c['photos']);
});

//Show page header
include(dirname(__FILE__) . '/views/header.php');

//Save uploaded photos
if (isset($_POST['picture_upload_form'])) {
    
    if ($c['options']['state'] !== 'uploading') {
        $c['photoContest']->queueError('Sorry, you cannot upload photos at this moment');
    } else {
	$uploadResult = '';
	foreach($_FILES['picture']['name'] as $index => $pictureName) {
		$uploadResult .= $c['photos']->addNew($pictureName, $_FILES['picture']['tmp_name'][$index]);
	}
	include('views/add_picture_result.php');
    }
        
//Photo upload form
} elseif (isset($_GET['anyadir']) && $context['uploading_pictures']) {
    
	include('views/upload_pictures_form.php');
        
//Save votes
} elseif (isset($_POST['votes']) && $user->votes == 0 && $context['votings_opened']) {
    
	$result = $user->add_votes($_POST['votes']);
	include('views/voting_result.php');
        
//Show contest results
} elseif (isset($_GET['results']) && $_GET['round'] = '2' && is_numeric($_GET['year'])
    && (($_GET['year'] <= $context['votings_ended']) || $c['user']->isAdmin()) 
    ) {
	$pictures->setYear($_GET['year']);
	$pictures->setRound($_GET['round']);
	include('views/results.php');

//Show cover
} else {
	include(dirname(__FILE__) . '/views/cover.php');
}

function __autoload($class) {
    require_once(dirname(__FILE__) . '/lib/' . str_replace('\\', '/', $class) . '.php');
}
