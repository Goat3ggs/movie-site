<?php
//Post content here
echo "<h2><a class='post-title' href=" . get_the_permalink() . ">" . get_the_title() . "</a></h2>"; // Show post title
the_excerpt();
