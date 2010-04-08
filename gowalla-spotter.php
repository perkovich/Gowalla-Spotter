<?php 
/*
Plugin Name: Gowalla Spotter
Plugin URI: http://www.strm.se/gowalla-spotter
Description: Displays activity in a <a href="http://gowalla.com">Gowalla</a> Spot in a Wordpress Post or Page.
Author: Per Åström
Version: 0.5
Author URI: http://www.strm.se
*/

//better display of relative time, from php.net
function nicetime($date)
{
    if(empty($date)) {
        return "No date provided";
    }

    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");

    $now             = time();
    $unix_date         = strtotime($date);

       // check validity of date
    if(empty($unix_date)) {    
        return "some time ago";
    }

    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = "ago";

    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j] {$tense}";
}


//main function 
function gowalla_spotter() {

//set SpotID and execute if there is one
    $post_id = get_the_ID();
	$spot_id = get_post_meta($post_id, "Gowalla", true);

if ($spot_id != "") {
    // get JSON from Gowalla with cURL
    // create a new cURL resource
    $ch = curl_init();

    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, "http://api.gowalla.com/spots/$spot_id");
    curl_setopt($ch,CURLOPT_HTTPHEADER, array ("Content-Type: application/json;charset=utf-8","Accept: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    // grab URL and store it
    $json = curl_exec($ch);

    // close cURL resource, and free up system resources
    curl_close($ch);

    //decode json array
    $json = json_decode($json); 

    //print headline with appropriate links  

    $output = "";
    $output .= "<b>Latest activity at <a href=\"http://gowalla.com/spots/" . $spot_id . "\">" . get_the_title() . "</a> from <a href=\"http://gowalla.com\">Gowalla</a> </b><br/>";

    // print the activity list: parse every item and write it on the page (or skip if there are no items)
    foreach ($json->last_checkins as $checkin) {
        $output .= sprintf(
            '<img src="%s" alt="" width="25" height="25" /> <a href="%s">%s %s</a> %s (%s)<br />',
            $checkin->user->image_url,
            'http://gowalla.com' . $checkin->user->url,
            $checkin->user->first_name,
            $checkin->user->last_name,
            $checkin->message,
            nicetime($checkin->created_at)
        );
    }

    echo $output;
}
}

// reminder: this must be present in the template within the loop: php if (function_exists('gowalla_spotter')) gowalla_spotter(); 

?>