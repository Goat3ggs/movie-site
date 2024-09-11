<?php

function runtime_prettier($min)
{
    return date('G \h\o\u\r i', mktime(0, $min)) . " minutes";
}

// mktime(hours, minutes, seconds); 
// you can use all three parameters or, in this case, only two.