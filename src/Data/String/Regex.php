<?php

$showRegexImpl = function($r) use (&$showRegexImpl) {
    return $r->pattern;
};

$regexImpl = function($left, $right = null, $s1 = null, $s2 = null) use (&$regexImpl) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$regexImpl) {

            return $regexImpl(...array_merge($__args, $more));
        };
    }
    $pattern = '/' . str_replace('/', '\/', $s1) . '/' . $s2;
    if (@preg_match($pattern, '') === false) {
        return $left(error_get_last()['message'] ?? "Invalid regex");
    }
    return $right((object)["pattern" => $pattern, "source" => $s1, "flags" => $s2]);
};

$source = function($r) use (&$source) {
    return $r->source;
};

$flagsImpl = function($r) use (&$flagsImpl) {
    return (object)[
        "multiline" => strpos($r->flags, 'm') !== false,
        "ignoreCase" => strpos($r->flags, 'i') !== false,
        "global" => strpos($r->flags, 'g') !== false,
        "dotAll" => strpos($r->flags, 's') !== false,
        "sticky" => strpos($r->flags, 'y') !== false,
        "unicode" => strpos($r->flags, 'u') !== false
    ];
};

$test = function($r, $s = null) use (&$test) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$test) {

            return $test(...array_merge($__args, $more));
        };
    }
    return preg_match($r->pattern, $s) === 1;
};

$_match = function($just, $nothing = null, $r = null, $s = null) use (&$_match) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_match) {

            return $_match(...array_merge($__args, $more));
        };
    }
    if (strpos($r->flags, 'g') !== false) {
        $matched = preg_match_all($r->pattern, $s, $matches);
        if ($matched) {
            $res = [];
            foreach ($matches[0] as $m) {
                $res[] = $m === "" ? $nothing : $just($m);
            }
            return $just($res);
        }
    } else {
        $matched = preg_match($r->pattern, $s, $matches);
        if ($matched) {
            $res = [];
            foreach ($matches as $m) {
                $res[] = $m === "" ? $nothing : $just($m);
            }
            return $just($res);
        }
    }
    return $nothing;
};

$replace = function($r, $s1 = null, $s2 = null) use (&$replace) {
    if (func_num_args() < 3) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$replace) {

            return $replace(...array_merge($__args, $more));
        };
    }
    $limit = strpos($r->flags, 'g') !== false ? -1 : 1;
    return preg_replace($r->pattern, $s1, $s2, $limit);
};

$_replaceBy = function($just, $nothing = null, $r = null, $f = null, $s = null) use (&$_replaceBy) {
    if (func_num_args() < 5) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_replaceBy) {

            return $_replaceBy(...array_merge($__args, $more));
        };
    }
    $limit = strpos($r->flags, 'g') !== false ? -1 : 1;
    return preg_replace_callback($r->pattern, function($matches) use ($f, $just, $nothing) {
        $match = $matches[0];
        $groups = [];
        for ($i = 1; $i < count($matches); $i++) {
            $groups[] = $matches[$i] === "" ? $nothing : $just($matches[$i]);
        }
        $fn = $f($match);
        return $fn($groups);
    }, $s, $limit);
};

$_search = function($just, $nothing = null, $r = null, $s = null) use (&$_search) {
    if (func_num_args() < 4) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$_search) {

            return $_search(...array_merge($__args, $more));
        };
    }
    if (preg_match($r->pattern, $s, $matches, PREG_OFFSET_CAPTURE)) {
        return $just($matches[0][1]);
    }
    return $nothing;
};

$split = function($r, $s = null) use (&$split) {
    if (func_num_args() < 2) {
        $__args = func_get_args();
        return function(...$more) use ($__args, &$split) {

            return $split(...array_merge($__args, $more));
        };
    }
    $limit = strpos($r->flags, 'g') !== false ? -1 : 2;
    return preg_split($r->pattern, $s, $limit);
};

$exports['showRegexImpl'] = $showRegexImpl;
$exports['regexImpl'] = $regexImpl;
$exports['source'] = $source;
$exports['flagsImpl'] = $flagsImpl;
$exports['test'] = $test;
$exports['_match'] = $_match;
$exports['replace'] = $replace;
$exports['_replaceBy'] = $_replaceBy;
$exports['_search'] = $_search;
$exports['split'] = $split;
return $exports;
