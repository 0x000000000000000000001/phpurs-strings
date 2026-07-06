<?php

$Data_String_CodePoints__unsafeCodePointAt0 = function($fallback, $str = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodePoints__unsafeCodePointAt0;
            return $Data_String_CodePoints__unsafeCodePointAt0(...array_merge($__args, $more));
        };
    }
    return mb_ord(mb_substr($str, 0, 1, 'UTF-8'), 'UTF-8');
};

$Data_String_CodePoints__codePointAt = function($fallback, $just = null, $nothing = null, $unsafeCodePointAt0 = null, $index = null, $str = null) {
    if (func_num_args() < 6) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodePoints__codePointAt;
            return $Data_String_CodePoints__codePointAt(...array_merge($__args, $more));
        };
    }
    $len = mb_strlen($str, 'UTF-8');
    if ($index < 0 || $index >= $len) return $nothing;
    return $just($unsafeCodePointAt0(mb_substr($str, $index, 1, 'UTF-8')));
};

$Data_String_CodePoints__countPrefix = function($fallback, $unsafeCodePointAt0 = null, $pred = null, $str = null) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodePoints__countPrefix;
            return $Data_String_CodePoints__countPrefix(...array_merge($__args, $more));
        };
    }
    $len = mb_strlen($str, 'UTF-8');
    for ($i = 0; $i < $len; $i++) {
        $char = mb_substr($str, $i, 1, 'UTF-8');
        $cp = $unsafeCodePointAt0($char);
        if (!$pred($cp)) return $i;
    }
    return $len;
};

$Data_String_CodePoints__fromCodePointArray = function($singleton, $cps = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodePoints__fromCodePointArray;
            return $Data_String_CodePoints__fromCodePointArray(...array_merge($__args, $more));
        };
    }
    $result = "";
    foreach ($cps as $cp) {
        $result .= mb_chr($cp, 'UTF-8');
    }
    return $result;
};

$Data_String_CodePoints__singleton = function($fallback, $cp = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodePoints__singleton;
            return $Data_String_CodePoints__singleton(...array_merge($__args, $more));
        };
    }
    return mb_chr($cp, 'UTF-8');
};

$Data_String_CodePoints__take = function($fallback, $n = null, $str = null) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodePoints__take;
            return $Data_String_CodePoints__take(...array_merge($__args, $more));
        };
    }
    return mb_substr($str, 0, $n, 'UTF-8');
};

$Data_String_CodePoints__toCodePointArray = function($fallback, $unsafeCodePointAt0 = null, $str = null) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_CodePoints__toCodePointArray;
            return $Data_String_CodePoints__toCodePointArray(...array_merge($__args, $more));
        };
    }
    $len = mb_strlen($str, 'UTF-8');
    $arr = [];
    for ($i = 0; $i < $len; $i++) {
        $arr[] = $unsafeCodePointAt0(mb_substr($str, $i, 1, 'UTF-8'));
    }
    return $arr;
};
