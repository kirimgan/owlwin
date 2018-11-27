<?php
use Carbon\Carbon;

function getAgeByDateBirth($value)
{
    return Carbon::parse($value)->diff(Carbon::now())->format('%y');
}


function prepareDateForDB($value)
{
    return date("Y-m-d", strtotime($value));
}

function prepareDateForView($value)
{
    return date("m/d/Y", strtotime($value));
}

function prepareYoutubeUrl($value)
{
    $hash = getYoutubeHash($value);
    return "//www.youtube.com/embed/" . $hash . "?rel=0";
}

function getYoutubeHash($value)
{
    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $value, $matches);
    if(count($matches) == 0) return $value;
    if(isset($matches[1])) return $matches[1];
    return $matches[0];
}

