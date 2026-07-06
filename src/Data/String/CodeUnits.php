<?php

$fromCharArray = function($a) use (&$fromCharArray) {
    return implode("", $a);
};

$toCharArray = function($s) use (&$toCharArray) {
    if ($s === "") return [];
    return str_split($s);
};

$singleton = function($c) use (&$singleton) {
    return $c;
};

$_charAt = function($just, $nothing = null, $i = null, $s = null) use (&$_charAt) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$fromCharArray) {

            return $_charAt(...array_merge($__args, $more));
        };
    }
    return ($i >= 0 && $i < strlen($s)) ? $just($s[$i]) : $nothing;
};

$_toChar = function($just, $nothing = null, $s = null) use (&$_toChar) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$toCharArray) {

            return $_toChar(...array_merge($__args, $more));
        };
    }
    return strlen($s) === 1 ? $just($s) : $nothing;
};

$length = function($s) use (&$length) {
    return strlen($s);
};

$countPrefix = function($p, $s = null) use (&$countPrefix) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$singleton) {

            return $countPrefix(...array_merge($__args, $more));
        };
    }
    $i = 0;
    $len = strlen($s);
    while ($i < $len && $p($s[$i])) {
        $i++;
    }
    return $i;
};

$_indexOf = function($just, $nothing = null, $x = null, $s = null) use (&$_indexOf) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_charAt) {

            return $_indexOf(...array_merge($__args, $more));
        };
    }
    $i = strpos($s, $x);
    return $i === false ? $nothing : $just($i);
};

$_indexOfStartingAt = function($just, $nothing = null, $x = null, $startAt = null, $s = null) use (&$_indexOfStartingAt) {
    if (func_num_args() < 5) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_toChar) {

            return $_indexOfStartingAt(...array_merge($__args, $more));
        };
    }
    if ($startAt < 0 || $startAt > strlen($s)) return $nothing;
    $i = strpos($s, $x, $startAt);
    return $i === false ? $nothing : $just($i);
};

$_lastIndexOf = function($just, $nothing = null, $x = null, $s = null) use (&$_lastIndexOf) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$length) {

            return $_lastIndexOf(...array_merge($__args, $more));
        };
    }
    if ($x === "") {
        return $just(strlen($s));
    }
    $i = strrpos($s, $x);
    return $i === false ? $nothing : $just($i);
};

$_lastIndexOfStartingAt = function($just, $nothing = null, $x = null, $startAt = null, $s = null) use (&$_lastIndexOfStartingAt) {
    if (func_num_args() < 5) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$countPrefix) {

            return $_lastIndexOfStartingAt(...array_merge($__args, $more));
        };
    }
    if ($x === "") return $just(min($startAt, strlen($s)));
    if ($startAt < 0) return $nothing;
    if ($startAt > strlen($s)) $startAt = strlen($s);
    $i = strrpos(substr($s, 0, $startAt + strlen($x)), $x);
    // JS lastIndexOf searches backwards from startAt. PHP strrpos searches the whole string up to offset, or with negative offset.
    // Equivalent logic:
    $sub = substr($s, 0, $startAt + strlen($x));
    $pos = strrpos($sub, $x);
    if ($pos !== false && $pos <= $startAt) {
        return $just($pos);
    }
    return $nothing;
};

$take = function($n, $s = null) use (&$take) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_indexOf) {

            return $take(...array_merge($__args, $more));
        };
    }
    return substr($s, 0, $n);
};

$drop = function($n, $s = null) use (&$drop) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_indexOfStartingAt) {

            return $drop(...array_merge($__args, $more));
        };
    }
    return substr($s, $n);
};

$slice = function($b, $e = null, $s = null) use (&$slice) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_lastIndexOf) {

            return $slice(...array_merge($__args, $more));
        };
    }
    // JS slice with negative indices
    $len = strlen($s);
    if ($b < 0) $b = max($len + $b, 0);
    else $b = min($b, $len);
    if ($e < 0) $e = max($len + $e, 0);
    else $e = min($e, $len);
    if ($e <= $b) return "";
    return substr($s, $b, $e - $b);
};

$splitAt = function($i, $s = null) use (&$splitAt) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_lastIndexOfStartingAt) {

            return $splitAt(...array_merge($__args, $more));
        };
    }
    return (object)[
        "before" => substr($s, 0, $i),
        "after" => substr($s, $i)
    ];
};

$exports['fromCharArray'] = $fromCharArray;
$exports['toCharArray'] = $toCharArray;
$exports['singleton'] = $singleton;
$exports['_charAt'] = $_charAt;
$exports['_toChar'] = $_toChar;
$exports['length'] = $length;
$exports['countPrefix'] = $countPrefix;
$exports['_indexOf'] = $_indexOf;
$exports['_indexOfStartingAt'] = $_indexOfStartingAt;
$exports['_lastIndexOf'] = $_lastIndexOf;
$exports['_lastIndexOfStartingAt'] = $_lastIndexOfStartingAt;
$exports['take'] = $take;
$exports['drop'] = $drop;
$exports['slice'] = $slice;
$exports['splitAt'] = $splitAt;
return $exports;
