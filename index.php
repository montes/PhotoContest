<?php
/**
 * Photo Contest
 * Written by @mooontes for furgovw.org
 */

function __autoload_photocontest($class) {
    $classFile = dirname(__FILE__) . '/lib/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($classFile))
        require_once($classFile);
}

spl_autoload_register('__autoload_photocontest');

//Define SMF's folder and load SSI
define('SMF_FOLDER', '/var/www/furgovw/');
require_once(dirname(__FILE__) . '/loadSMFSSI.php');
require_once(dirname(__FILE__) . '/lib/imagine.phar');

$db             = new PhotoContest\SMFDb($smcFunc);
$options        = PhotoContest\PhotoContest::loadConfig($db);
$user           = new PhotoContest\SMFUser($context, $user_info, $db, $options);
$photos         = new PhotoContest\Photos();
$photoContest   = new PhotoContest\PhotoContest($db, $user, $photos, $options);

/*$options = array(
    'state'         => 'closed',
    'current_round' => '0',
    'total_rounds'  => '0'
);
PhotoContest\PhotoContest::saveConfig($db, $options);*/

//Show page header
include(dirname(__FILE__) . '/views/header.php');

//Create new photo contest
if (isset($_GET['create_new_photo_contest'])) {
    include('views/new_photo_contest_form.php');

} elseif (isset($_GET['admin_index'])) {
    $contests = $photoContest->getContests();
    include('views/admin_index.php');

//Save new photo contest
} elseif (isset($_POST['new_contest_submit'])) {
    $photoContest->createFromForm();
    $contests = $photoContest->getContests();
    include('views/admin_index.php');

//Save uploaded photos
} elseif (isset($_POST['picture_upload_form'])) {
    
    if ($options['state'] !== 'uploading') {
        $photoContest->queueError('Sorry, you cannot upload photos at this moment');
    } else {
        $uploadResult = '';
	    foreach($_FILES['picture']['name'] as $index => $pictureName) {
	        $uploadResult .= $photos->addNew($pictureName, $_FILES['picture']['tmp_name'][$index]);
	    }
	    include('views/add_picture_result.php');
    }
        
//Photo upload form
} elseif (isset($_GET['anyadir']) && $options['state'] === 'uploading_pictures') {
    
	include('views/upload_pictures_form.php');
        
//Save votes
} elseif (isset($_POST['votes']) && $user->votes == 0 && $options['state'] === 'votings_opened') {
    
	$result = $user->add_votes($_POST['votes']);
	include('views/voting_result.php');
        
//Show contest results
} elseif (isset($_GET['results']) && $_GET['round'] = '2' && is_numeric($_GET['year'])
    && (($_GET['year'] <= $options['state'] === 'votings_ended') || $user->isAdmin()) 
    ) {
	$photos->setYear($_GET['year']);
	$photos->setRound($_GET['round']);
	include('views/results.php');

//Show cover
} else {
	include(dirname(__FILE__) . '/views/cover.php');
}





function __($text)
{
    return $text;
}

function _e($text)
{
    echo $text;
}