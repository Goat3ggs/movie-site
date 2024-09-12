<?php

// mktime(hours, minutes, seconds); 
// you can use all three parameters or, in this case, only two.

function runtime_prettier($min)
{
    return date('G \h\o\u\r i', mktime(0, $min)) . " minutes";
}

function check_old_movie($year)
{
    $yearDiff = date('Y') - $year;

    if ($yearDiff <= 40) {
        return "FALSE";
    } else {
        echo '<span class="badge rounded-pill  text-bg-warning">Old movie: ' . $yearDiff . ' years</span>';
        return $yearDiff;
    }
}
