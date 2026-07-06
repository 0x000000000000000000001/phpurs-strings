<?php

$Data_String_CodeUnits_fromCharArray = function($a) {
    return implode("", $a);
};

$Data_String_CodeUnits_toCharArray = function($s) {
    if ($s === "") return [];
    return str_split($s);
};

$Data_String_CodeUnits_singleton = function($c) {
    return $c;
};

$Data_String_CodeUnits__charAt = function($just, $nothing = null, $i = null, $s = null) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodeUnits__charAt;
            return $Data_String_CodeUnits__charAt(...array_merge($__args, $more));
        };
    }
    return ($i >= 0 && $i < strlen($s)) ? $just($s[$i]) : $nothing;
};

$Data_String_CodeUnits__toChar = function($just, $nothing = null, $s = null) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodeUnits__toChar;
            return $Data_String_CodeUnits__toChar(...array_merge($__args, $more));
        };
    }
    return strlen($s) === 1 ? $just($s) : $nothing;
};

$Data_String_CodeUnits_length = function($s) {
    return strlen($s);
};

$Data_String_CodeUnits_countPrefix = function($p, $s = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodeUnits_countPrefix;
            return $Data_String_CodeUnits_countPrefix(...array_merge($__args, $more));
        };
    }
    $i = 0;
    $len = strlen($s);
    while ($i < $len && $p($s[$i])) {
        $i++;
    }
    return $i;
};

$Data_String_CodeUnits__indexOf = function($just, $nothing = null, $x = null, $s = null) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodeUnits__indexOf;
            return $Data_String_CodeUnits__indexOf(...array_merge($__args, $more));
        };
    }
    $i = strpos($s, $x);
    return $i === false ? $nothing : $just($i);
};

$Data_String_CodeUnits__indexOfStartingAt = function($just, $nothing = null, $x = null, $startAt = null, $s = null) {
    if (func_num_args() < 5) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodeUnits__indexOfStartingAt;
            return $Data_String_CodeUnits__indexOfStartingAt(...array_merge($__args, $more));
        };
    }
    if ($startAt < 0 || $startAt > strlen($s)) return $nothing;
    $i = strpos($s, $x, $startAt);
    return $i === false ? $nothing : $just($i);
};

$Data_String_CodeUnits__lastIndexOf = function($just, $nothing = null, $x = null, $s = null) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodeUnits__lastIndexOf;
            return $Data_String_CodeUnits__lastIndexOf(...array_merge($__args, $more));
        };
    }
    if ($x === "") {
        return $just(strlen($s));
    }
    $i = strrpos($s, $x);
    return $i === false ? $nothing : $just($i);
};

$Data_String_CodeUnits__lastIndexOfStartingAt = function($just, $nothing = null, $x = null, $startAt = null, $s = null) {
    if (func_num_args() < 5) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodeUnits__lastIndexOfStartingAt;
            return $Data_String_CodeUnits__lastIndexOfStartingAt(...array_merge($__args, $more));
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

$Data_String_CodeUnits_take = function($n, $s = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodeUnits_take;
            return $Data_String_CodeUnits_take(...array_merge($__args, $more));
        };
    }
    return substr($s, 0, $n);
};

$Data_String_CodeUnits_drop = function($n, $s = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodeUnits_drop;
            return $Data_String_CodeUnits_drop(...array_merge($__args, $more));
        };
    }
    return substr($s, $n);
};

$Data_String_CodeUnits_slice = function($b, $e = null, $s = null) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodeUnits_slice;
            return $Data_String_CodeUnits_slice(...array_merge($__args, $more));
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

$Data_String_CodeUnits_splitAt = function($i, $s = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodeUnits_splitAt;
            return $Data_String_CodeUnits_splitAt(...array_merge($__args, $more));
        };
    }
    return (object)[
        "before" => substr($s, 0, $i),
        "after" => substr($s, $i)
    ];
};
