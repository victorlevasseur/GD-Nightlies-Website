<?php

function endsWith( $str, $sub )
{
   return ( substr( $str, strlen( $str ) - strlen( $sub ) ) === $sub );
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <title>GDevelop nightlies</title>
    </head>
    <body>
        <div class="titlebox">
            <h1>GDevelop nightlies</h1>
        </div>
        <p>
            <a class="btn" href="http://www.compilgames.net">🠈 Back to the website</a>
        </p>
        <p>
            GDevelop nightlies are built from the source repository of GDevelop.
            A new nightly build is produced each day.
        </p>
        <p>
            <strong>
                Please note that these versions may be instable or not work at all.
            </strong>
        </p>
        <div class="titlebox">
            <h2>Windows</h2>
        </div>
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
                if( preg_match( "/^gdevelop-([0-9]{2})([0-9]{2})([0-9]{2})\\.exe$/", $file, $matches ) == 1 )
                {
                    ?>
                    <li>
                        <strong>GDevelop</strong> built on the <strong><?php echo $matches[3]."-".$matches[2]."-".$matches[1]; ?></strong>:
                        <a class="btn" href="<?php echo "files/".$matches[0]; ?>">Installer (.exe)</a>
                        <a class="btn" href="<?php echo "files/gdevelop-".$matches[1].$matches[2].$matches[3].".7z"; ?>">Archive (.7z)</a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <div class="titlebox">
            <h2>Linux</h2>
        </div>
        <p>
            <em>
                Not available yet!
            </em>
        </p>
    </body>
</html>
