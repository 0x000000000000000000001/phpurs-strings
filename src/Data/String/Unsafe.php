<?php

$charAt = function($i, $s = null) use (&$charAt) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$charAt) {

            return $charAt(...array_merge($__args, $more));
        };
    }
    if ($i >= 0 && $i < strlen($s)) return $s[$i];
    throw new \Exception("Data.String.Unsafe.charAt: Invalid index.");
};

$char = function($s) use (&$char) {
    if (strlen($s) === 1) return $s[0];
    throw new \Exception("Data.String.Unsafe.char: Expected string of length 1.");
};

$exports['charAt'] = $charAt;
$exports['char'] = $char;
return $exports;
