<?php
include 'vimeo.php';

//DATE CONFIGURATION
//---------------------------------------------
$today = date("D M j Y");
date_default_timezone_set('America/Chicago');
//---------------------------------------------

$vimeo = new phpVimeo('bb5b982d90d89cf2dfce78317eb63446', 'd620a5c1ea8734d4', '5121c29d3aac80c0691935e849bab97f', '4dfd3de08016923d81de17a6a2c735742f623e2b');

try {
	//------ location of video file must be relative to Cmd.exe current working directory
    $video_id = $vimeo->upload('ready.mp4');

    if ($video_id) {
        echo '<a href="http://vimeo.com/' . $video_id . '">Upload successful!</a>';

        //$vimeo->call('vimeo.videos.setPrivacy', array('privacy' => 'anyone', 'video_id' => $video_id));
        $vimeo->call('vimeo.videos.setTitle', array('title' => 'GBFIC:' . $today, 'video_id' => $video_id));
        $vimeo->call('vimeo.videos.setDescription', array('description' => $today, 'video_id' => $video_id));
    }
    else {
        echo "Video file did not exist!";
    }
}
catch (VimeoAPIException $e) {
    echo "Encountered an API error -- code {$e->getCode()} - {$e->getMessage()}";
}
