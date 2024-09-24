<?php

// mktime(hours, minutes, seconds); 
// you can use all three parameters or, in this case, only two.

function runtime_prettier($movie_length = 0)
{
    if ($movie_length == 0 || !is_numeric($movie_length)) {
        return "No runtime data";
    } else if ($movie_length == 1) {
        return $movie_length . " minute";
    } else if ($movie_length > 1 && $movie_length < 60) {
        return $movie_length . "minutes";
    } else {
        $hours = floor($movie_length / 60);
        $minutes = $movie_length % 60;

        return $hours . (($hours == 1) ? ' hour ' : ' hours ') . $minutes . (($minutes == 1) ? ' minute ' : ' minutes ');
    }
}

// function runtime_prettier($min)
// {
//     if ($min > 60) {
//         return date('G\h\ i', mktime(0, $min)) . "m";
//     } else {
//         return $min . "m";
//     }
// }

// Check if movie is old function
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

// Get current date then greet function
function greeting()
{
    date_default_timezone_set('Europe/Bucharest');

    // date("H") i
    $date = date("H");
    if ($date >= 1 && $date <= 10) {
        echo "<span>Good Morning!</span>";
    } else if ($date > 10 && $date < 17) {
        echo "<span>Good Afternoon!</span>";
    } else if ($date >= 17 && $date < 21) {
        echo "<span>Good Evening!</span>";
    } else {
        echo "<span>Good Night!</span>";
    }
}
