<?php

function get_commits_of_build($installer_filename)
{
    if( preg_match( "/^gdevelop-([0-9]{2})([0-9]{2})([0-9]{2})\\.exe$/", $installer_filename, $matches ) != 1 )
        return FALSE; //This is not a valid installer

    // Processing the dates
    $installer_datetime = new DateTime("20".$matches[1]."-".$matches[2]."-".$matches[3], new DateTimeZone("UTC"));
    $installer_datetime->setTime(12, 0);

    $previous_datetime = clone $installer_datetime;
    $previous_datetime->sub(new DateInterval("P1D"));

    // Generate the request URI and parameters
    $github_request =
        "https://api.github.com/repos/4ian/GD/commits?sha=master&since=".
        "\"".urlencode($previous_datetime->format(DateTime::ISO8601))."\""
        ."&until=".
        "\"".urlencode($installer_datetime->format(DateTime::ISO8601))."\"";

    // Github refuses the connections without User-Agent, so force file_get_contents to use one.
    $opts = array(
      'http'=>array(
        'method' => "GET",
        'header' => "User-Agent: \"GDevelop-Nightlies-Website\""
      )
    );
    $context = stream_context_create($opts);

    // Get the commits
    $commits_list_json = file_get_contents($github_request, FALSE, $context);

    // Decode the JSON
    $commits_list = json_decode($commits_list_json, TRUE);
    if($commits_list == NULL)
        return []; //Invalid JSON

    return $commits_list;
}

?>
