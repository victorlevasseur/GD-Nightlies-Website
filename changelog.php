<?php

include_once "github.php";

$build = $_GET["build"];

$changes = get_commits_of_build($build);

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
            <h1>Changelog for <?php echo $build ?> </h1>
        </div>
        <p>
            <a class="btn" href="index.php">🠈 Back to the list</a>
        </p>
        <?php
        if($changes === FALSE)
        {
            ?>
            <p><strong>This nightly doesn't exists!</strong></p>
            <?php
        }
        else if(count($changes) == 0)
        {
            ?>
            <p><strong>This nightly is the same than the previous one (no changes)!</strong></p>
            <?php
        }
        else
        {
            ?>
            <table>
                <thead>
                    <th>Date and Time</th>
                    <th>Description</th>
                    <th>Author</th>
                    <th>Commit</th>
                </thead>
                <tbody>
                    <?php
                    foreach($changes as $commit)
                    {
                        echo "<tr>";

                        $commit_date = new DateTime($commit["commit"]["author"]["date"]);

                        $commit_description = $commit["commit"]["message"];

                        $commit_author = $commit["commit"]["author"]["name"];
                        $commit_author_image = $commit["author"]["avatar_url"];

                        $commit_sha = substr($commit["sha"], 0, 8);
                        $commit_url = $commit["html_url"];


                        echo "<td>".$commit_date->format("Y-m-d H:i")."</td>";
                        echo "<td>".$commit_description."</td>";
                        echo "<td><img src='".$commit_author_image."' width='32'/>".$commit_author."</td>";
                        echo "<td><a href='".$commit_url."'>".$commit_sha."</td>";

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php
        }
        ?>
    </body>
</html>
