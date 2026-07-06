<?php

$Data_String_Regex_showRegexImpl = function($r) {
    return "/" . $r->source . "/" . $r->flags;
};

$Data_String_Regex_regexImpl = function($left, $right = null, $s1 = null, $s2 = null) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_Regex_regexImpl;
            return $Data_String_Regex_regexImpl(...array_merge($__args, $more));
        };
    }
    try {
        $php_flags = "";
        if (strpos($s2, 'i') !== false) $php_flags .= 'i';
        if (strpos($s2, 'm') !== false) $php_flags .= 'm';
        if (strpos($s2, 's') !== false) $php_flags .= 's';
        if (strpos($s2, 'u') !== false) $php_flags .= 'u';
        
        $regex = (object)[
            "source" => $s1,
            "flags" => $s2,
            "phpPattern" => "~" . str_replace("~", "\\~", $s1) . "~" . $php_flags,
            "global" => strpos($s2, 'g') !== false
        ];
        
        if (@preg_match($regex->phpPattern, '') === false) {
            $err = error_get_last();
            return $left($err ? $err['message'] : "Invalid regex");
        }
        return $right($regex);
    } catch (\Exception $e) {
        return $left($e->getMessage());
    }
};

$Data_String_Regex_source = function($r) {
    return $r->source;
};

$Data_String_Regex_flagsImpl = function($r) {
    return (object)[
        "multiline" => strpos($r->flags, 'm') !== false,
        "ignoreCase" => strpos($r->flags, 'i') !== false,
        "global" => $r->global,
        "dotAll" => strpos($r->flags, 's') !== false,
        "sticky" => strpos($r->flags, 'y') !== false,
        "unicode" => strpos($r->flags, 'u') !== false
    ];
};

$Data_String_Regex_test = function($r, $s = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_Regex_test;
            return $Data_String_Regex_test(...array_merge($__args, $more));
        };
    }
    return preg_match($r->phpPattern, $s) === 1;
};

$Data_String_Regex__match = function($just, $nothing = null, $r = null, $s = null) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_Regex__match;
            return $Data_String_Regex__match(...array_merge($__args, $more));
        };
    }
    if ($r->global) {
        if (preg_match_all($r->phpPattern, $s, $matches, PREG_PATTERN_ORDER | PREG_UNMATCHED_AS_NULL) > 0) {
            $res = [];
            foreach ($matches[0] as $m) {
                $res[] = ($m === null) ? $nothing : $just($m);
            }
            return $just($res);
        }
        return $nothing;
    } else {
        if (preg_match($r->phpPattern, $s, $matches, PREG_UNMATCHED_AS_NULL) > 0) {
            $res = [];
            foreach ($matches as $m) {
                $res[] = ($m === null) ? $nothing : $just($m);
            }
            return $just($res);
        }
        return $nothing;
    }
};

$Data_String_Regex_replace = function($r, $s1 = null, $s2 = null) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_Regex_replace;
            return $Data_String_Regex_replace(...array_merge($__args, $more));
        };
    }
    $limit = $r->global ? -1 : 1;
    $replacement = str_replace('$&', '$0', $s1);
    return preg_replace($r->phpPattern, $replacement, $s2, $limit);
};

$Data_String_Regex__replaceBy = function($just, $nothing = null, $r = null, $f = null, $s = null) {
    if (func_num_args() < 5) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_Regex__replaceBy;
            return $Data_String_Regex__replaceBy(...array_merge($__args, $more));
        };
    }
    $limit = $r->global ? -1 : 1;
    return preg_replace_callback($r->phpPattern, function($matches) use ($f, $just, $nothing) {
        $match = $matches[0];
        $groups = [];
        for ($i = 1; $i < count($matches); $i++) {
            $groups[] = ($matches[$i] === null) ? $nothing : $just($matches[$i]);
        }
        return $f($match)($groups);
    }, $s, $limit, $count, PREG_UNMATCHED_AS_NULL);
};

$Data_String_Regex__search = function($just, $nothing = null, $r = null, $s = null) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_Regex__search;
            return $Data_String_Regex__search(...array_merge($__args, $more));
        };
    }
    if (preg_match($r->phpPattern, $s, $matches, PREG_OFFSET_CAPTURE)) {
        return $just($matches[0][1]);
    }
    return $nothing;
};

$Data_String_Regex_split = function($r, $s = null) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args) {
            global $Data_String_Regex_split;
            return $Data_String_Regex_split(...array_merge($__args, $more));
        };
    }
    return preg_split($r->phpPattern, $s);
};
