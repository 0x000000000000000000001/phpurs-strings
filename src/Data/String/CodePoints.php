<?php

if (!function_exists('Data_String_CodePoints_utf8_ord')) {
    function Data_String_CodePoints_utf8_ord($char) {
        if ($char === '') return 0;
        $c0 = ord($char[0]);
        if ($c0 < 0x80) {
            return $c0;
        } elseif ($c0 < 0xE0) {
            return (($c0 & 0x1F) << 6) | (ord($char[1]) & 0x3F);
        } elseif ($c0 < 0xF0) {
            return (($c0 & 0x0F) << 12) | ((ord($char[1]) & 0x3F) << 6) | (ord($char[2]) & 0x3F);
        } else {
            return (($c0 & 0x07) << 18) | ((ord($char[1]) & 0x3F) << 12) | ((ord($char[2]) & 0x3F) << 6) | (ord($char[3]) & 0x3F);
        }
    }
}

if (!function_exists('Data_String_CodePoints_utf8_chr')) {
    function Data_String_CodePoints_utf8_chr($code) {
        if ($code < 0x80) {
            return chr($code);
        } elseif ($code < 0x800) {
            return chr(0xC0 | ($code >> 6)) . chr(0x80 | ($code & 0x3F));
        } elseif ($code < 0x10000) {
            return chr(0xE0 | ($code >> 12)) . chr(0x80 | (($code >> 6) & 0x3F)) . chr(0x80 | ($code & 0x3F));
        } else {
            return chr(0xF0 | ($code >> 18)) . chr(0x80 | (($code >> 12) & 0x3F)) . chr(0x80 | (($code >> 6) & 0x3F)) . chr(0x80 | ($code & 0x3F));
        }
    }
}

$_unsafeCodePointAt0 = function($fallback, $str = null) use (&$_unsafeCodePointAt0) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_unsafeCodePointAt0) {

            return $_unsafeCodePointAt0(...array_merge($__args, $more));
        };
    }
    return Data_String_CodePoints_utf8_ord(iconv_substr($str, 0, 1, 'UTF-8'));
};

$_codePointAt = function($fallback, $just = null, $nothing = null, $unsafeCodePointAt0 = null, $index = null, $str = null) use (&$_codePointAt) {
    if (func_num_args() < 6) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_codePointAt) {

            return $_codePointAt(...array_merge($__args, $more));
        };
    }
    $len = iconv_strlen($str, 'UTF-8');
    if ($index < 0 || $index >= $len) return $nothing;
    return $just($unsafeCodePointAt0(iconv_substr($str, $index, 1, 'UTF-8')));
};

$_countPrefix = function($fallback, $unsafeCodePointAt0 = null, $pred = null, $str = null) use (&$_countPrefix) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_countPrefix) {

            return $_countPrefix(...array_merge($__args, $more));
        };
    }
    $len = iconv_strlen($str, 'UTF-8');
    for ($i = 0; $i < $len; $i++) {
        $char = iconv_substr($str, $i, 1, 'UTF-8');
        $cp = $unsafeCodePointAt0($char);
        if (!$pred($cp)) return $i;
    }
    return $len;
};

$_fromCodePointArray = function($singleton, $cps = null) use (&$_fromCodePointArray) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_fromCodePointArray) {

            return $_fromCodePointArray(...array_merge($__args, $more));
        };
    }
    $result = "";
    foreach ($cps as $cp) {
        $result .= Data_String_CodePoints_utf8_chr($cp);
    }
    return $result;
};

$_singleton = function($fallback, $cp = null) use (&$_singleton) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_singleton) {

            return $_singleton(...array_merge($__args, $more));
        };
    }
    return Data_String_CodePoints_utf8_chr($cp);
};

$_take = function($fallback, $n = null, $str = null) use (&$_take) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_take) {

            return $_take(...array_merge($__args, $more));
        };
    }
    return iconv_substr($str, 0, $n, 'UTF-8');
};

$_toCodePointArray = function($fallback, $unsafeCodePointAt0 = null, $str = null) use (&$_toCodePointArray) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_toCodePointArray) {

            return $_toCodePointArray(...array_merge($__args, $more));
        };
    }
    $len = iconv_strlen($str, 'UTF-8');
    $arr = [];
    for ($i = 0; $i < $len; $i++) {
        $arr[] = $unsafeCodePointAt0(iconv_substr($str, $i, 1, 'UTF-8'));
    }
    return $arr;
};

$exports['_unsafeCodePointAt0'] = $_unsafeCodePointAt0;
$exports['_codePointAt'] = $_codePointAt;
$exports['_countPrefix'] = $_countPrefix;
$exports['_fromCodePointArray'] = $_fromCodePointArray;
$exports['_singleton'] = $_singleton;
$exports['_take'] = $_take;
$exports['_toCodePointArray'] = $_toCodePointArray;
return $exports;
