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


// Functie pentru citirea fisierului JSON
function get_movie_favorites() {
    global $json_file_path;

    // Daca fisierul nu exista, returnam un array gol
    if (!file_exists($json_file_path)) {
        return [];
    }

    // Citim continutul fisierului
    $json_data = file_get_contents($json_file_path);

    // Decodam continutul JSON intr-un array PHP
    return json_decode($json_data, true);
}

// Functie pentru salvarea modificarilor in fisierului JSON
function save_movie_favorites($data) {
    global $json_file_path;

    // Codificam array-ul PHP intr-un strin JSON
    $json_data = json_encode($data, JSON_PRETTY_PRINT);

    // Scrie stringuil JSON in fisier
    file_put_contents($json_file_path, $json_data);
}