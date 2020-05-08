<?php
function format_uang($request)
{
    if ($request->input('page')) {
        $page = $request->input('page');
    } else {
        $page = 1;
    }

    $next = $page + 1;
    $pref = $page - 1;
}
