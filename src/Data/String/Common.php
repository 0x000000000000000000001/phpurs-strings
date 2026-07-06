<?php

$Data_String_Common__localeCompare = function($lt, $eq = null, $gt = null, $s1 = null, $s2 = null) {
    if (func_num_args() < 5) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_Common__localeCompare;
            return $Data_String_Common__localeCompare(...array_merge($__args, $more));
        };
    }
    $result = strcmp($s1, $s2);
    return $result < 0 ? $lt : ($result > 0 ? $gt : $eq);
};

$Data_String_Common_replace = function($s1, $s2 = null, $s3 = null) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_Common_replace;
            return $Data_String_Common_replace(...array_merge($__args, $more));
        };
    }
    $pos = strpos($s3, $s1);
    if ($pos !== false) {
        return substr_replace($s3, $s2, $pos, strlen($s1));
    }
    return $s3;
};

$Data_String_Common_replaceAll = function($s1, $s2 = null, $s3 = null) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_Common_replaceAll;
            return $Data_String_Common_replaceAll(...array_merge($__args, $more));
        };
    }
    return str_replace($s1, $s2, $s3);
};

$Data_String_Common_split = function($sep, $s = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_Common_split;
            return $Data_String_Common_split(...array_merge($__args, $more));
        };
    }
    if ($sep === "") {
        return str_split($s);
    }
    return explode($sep, $s);
};

$Data_String_Common_toLower = function($s) {
    return strtolower($s);
};

$Data_String_Common_toUpper = function($s) {
    return strtoupper($s);
};

$Data_String_Common_trim = function($s) {
    return trim($s);
};

$Data_String_Common_joinWith = function($s, $xs = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_Common_joinWith;
            return $Data_String_Common_joinWith(...array_merge($__args, $more));
        };
    }
    return implode($s, $xs);
};
