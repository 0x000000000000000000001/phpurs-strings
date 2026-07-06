<?php

$Data_String_Unsafe_charAt = function($i, $s = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_Unsafe_charAt;
            return $Data_String_Unsafe_charAt(...array_merge($__args, $more));
        };
    }
    if ($i >= 0 && $i < strlen($s)) return $s[$i];
    throw new \Exception("Data.String.Unsafe.charAt: Invalid index.");
};

$Data_String_Unsafe_char = function($s) {
    if (strlen($s) === 1) return $s[0];
    throw new \Exception("Data.String.Unsafe.char: Expected string of length 1.");
};
