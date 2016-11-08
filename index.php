<?php

function endsWith( $str, $sub )
{
   return ( substr( $str, strlen( $str ) - strlen( $sub ) ) === $sub );
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>GDevelop nightlies</title>
    </head>
    <body>
        <h1>GDevelop nightlies</h1>
        <p>
            GDevelop nightlies are built from the source repository of GDevelop.
            A new nightly build is produced each day.
        </p>
        <p>
            <strong>
                Please note that these versions may be instable or not work at all.
            </strong>
        </p>
        <h2>Windows</h2>
        <p>
            Here is the list of the available nightlies of GDevelop. They are sorted
            from the newest to the oldest one.
        </p>
        <ul>
            <?php
            $files = scandir( "files", SCANDIR_SORT_DESCENDING );
            $nightly_installer = [];

            foreach( $files as $file )
            {
                if( preg_match( "^gdevelop-([0-9]{2})([0-9]{2})([0-9]{2})\.exe$", $file, $matches ) == 1 )
                {
                    ?>
                    <li>
                        GDevelop built on the <?php echo $matches[3] + "-" + $matches[2] + "-" + $matches[1]; ?>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <h2>Linux</h2>
        <p>
            <em>
                Not available yet!
            </em>
        </p>
    </body>
</html>
