<?php

$charAt = function($i, $s) use (&$charAt) {
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
