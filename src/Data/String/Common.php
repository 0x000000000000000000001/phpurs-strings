<?php

$_localeCompare = function($lt, $eq, $gt, $s1, $s2) use (&$_localeCompare) {
    $result = strcmp($s1, $s2);
    return $result < 0 ? $lt : ($result > 0 ? $gt : $eq);
};

$replace = function($s1, $s2, $s3) use (&$replace) {
    $pos = strpos($s3, $s1);
    if ($pos !== false) {
        return substr_replace($s3, $s2, $pos, strlen($s1));
    }
    return $s3;
};

$replaceAll = function($s1, $s2, $s3) use (&$replaceAll) {
    return str_replace($s1, $s2, $s3);
};

$split = function($sep, $s) use (&$split) {
    if ($sep === "") {
        return str_split($s);
    }
    return explode($sep, $s);
};

$toLower = function($s) use (&$toLower) {
    return mb_strtolower($s, 'UTF-8');
};

$toUpper = function($s) use (&$toUpper) {
    return mb_strtoupper($s, 'UTF-8');
};

$trim = function($s) use (&$trim) {
    return trim($s);
};

$joinWith = function($s, $xs) use (&$joinWith) {
    return implode($s, $xs);
};

$exports['_localeCompare'] = $_localeCompare;
$exports['replace'] = $replace;
$exports['replaceAll'] = $replaceAll;
$exports['split'] = $split;
$exports['toLower'] = $toLower;
$exports['toUpper'] = $toUpper;
$exports['trim'] = $trim;
$exports['joinWith'] = $joinWith;
return $exports;
