<?php

$_localeCompare = function($lt, $eq = null, $gt = null, $s1 = null, $s2 = null) use (&$_localeCompare) {
    if (func_num_args() < 5) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_localeCompare) {

            return $_localeCompare(...array_merge($__args, $more));
        };
    }
    $result = strcmp($s1, $s2);
    return $result < 0 ? $lt : ($result > 0 ? $gt : $eq);
};

$replace = function($s1, $s2 = null, $s3 = null) use (&$replace) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$replace) {

            return $replace(...array_merge($__args, $more));
        };
    }
    $pos = strpos($s3, $s1);
    if ($pos !== false) {
        return substr_replace($s3, $s2, $pos, strlen($s1));
    }
    return $s3;
};

$replaceAll = function($s1, $s2 = null, $s3 = null) use (&$replaceAll) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$replaceAll) {

            return $replaceAll(...array_merge($__args, $more));
        };
    }
    return str_replace($s1, $s2, $s3);
};

$split = function($sep, $s = null) use (&$split) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$split) {

            return $split(...array_merge($__args, $more));
        };
    }
    if ($sep === "") {
        return str_split($s);
    }
    return explode($sep, $s);
};

$toLower = function($s) use (&$toLower) {
    return strtolower($s);
};

$toUpper = function($s) use (&$toUpper) {
    return strtoupper($s);
};

$trim = function($s) use (&$trim) {
    return trim($s);
};

$joinWith = function($s, $xs = null) use (&$joinWith) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$joinWith) {

            return $joinWith(...array_merge($__args, $more));
        };
    }
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
