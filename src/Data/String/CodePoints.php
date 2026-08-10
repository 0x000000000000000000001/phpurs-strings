<?php

if (!\function_exists('Data_String_CodePoints_utf8_ord')) {
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

if (!\function_exists('Data_String_CodePoints_utf8_chr')) {
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

if (!\function_exists('Data_String_CodePoints_next_char_len')) {
    function Data_String_CodePoints_next_char_len($str, $offset) {
        if ($offset >= strlen($str)) return 0;
        $c0 = ord($str[$offset]);
        if ($c0 < 0x80) return 1;
        if ($c0 < 0xE0) return 2;
        if ($c0 < 0xF0) return 3;
        return 4;
    }
}

$_unsafeCodePointAt0 = function($fallback, $str) use (&$_unsafeCodePointAt0) {
    return Data_String_CodePoints_utf8_ord($str);
};

$_codePointAt = function($fallback, $just, $nothing, $unsafeCodePointAt0, $index, $str) use (&$_codePointAt) {
    if ($index < 0) return $nothing;
    $len = strlen($str);
    $offset = 0;
    $cpIndex = 0;
    while ($offset < $len) {
        $charLen = Data_String_CodePoints_next_char_len($str, $offset);
        if ($cpIndex === $index) {
            return $just($unsafeCodePointAt0(substr($str, $offset, $charLen)));
        }
        $offset += $charLen;
        $cpIndex++;
    }
    return $nothing;
};

$_countPrefix = function($fallback, $unsafeCodePointAt0, $pred, $str) use (&$_countPrefix) {
    $len = strlen($str);
    $offset = 0;
    $cpIndex = 0;
    while ($offset < $len) {
        $charLen = Data_String_CodePoints_next_char_len($str, $offset);
        $char = substr($str, $offset, $charLen);
        $cp = $unsafeCodePointAt0($char);
        if (!$pred($cp)) return $cpIndex;
        $offset += $charLen;
        $cpIndex++;
    }
    return $cpIndex;
};

$_fromCodePointArray = function($singleton, $cps) use (&$_fromCodePointArray) {
    $result = "";
    foreach ($cps as $cp) {
        $result .= Data_String_CodePoints_utf8_chr($cp);
    }
    return $result;
};

$_singleton = function($fallback, $cp) use (&$_singleton) {
    return Data_String_CodePoints_utf8_chr($cp);
};

$_take = function($fallback, $n, $str) use (&$_take) {
    if ($n <= 0) return "";
    $len = strlen($str);
    $offset = 0;
    $cpIndex = 0;
    while ($offset < $len && $cpIndex < $n) {
        $charLen = Data_String_CodePoints_next_char_len($str, $offset);
        $offset += $charLen;
        $cpIndex++;
    }
    return substr($str, 0, $offset);
};

$_toCodePointArray = function($fallback, $unsafeCodePointAt0, $str) use (&$_toCodePointArray) {
    $len = strlen($str);
    $offset = 0;
    $arr = [];
    while ($offset < $len) {
        $charLen = Data_String_CodePoints_next_char_len($str, $offset);
        $arr[] = $unsafeCodePointAt0(substr($str, $offset, $charLen));
        $offset += $charLen;
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
