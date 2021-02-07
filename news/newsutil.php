<?php

$postid = "";
$posttext = "";

function printNewsLinks() {
    include 'dbconnect.php';
    $res = $mysqli->query("SELECT id, dateposted, substring(posttext, 1, 256) AS preview FROM posts");

    if (!$res) {
        return false;
    }

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            echo '<tr class="row-a"><td class="first"><a href="newsadmin.php?postid="' .  $row["id"] . '">' . $row["id"] . '</a></td>' .
            '<td><a href="newsadmin.php?postid=' .  $row["id"] . '">' . $row["dateposted"] . "</a></td>" .
            "<td>" . $row["preview"] . '...</td><td><a href="newsadmin.php?postid='. $row["id"] . '">Edit</a> / <a href="#" onclick="deleteWarning(' . $row["id"] . ');">Delete</a></td></tr>'; 
        }
    }
}

function deletePost() {
    if (isset($_GET["deleteid"])) {
        include 'dbconnect.php';

        $sql = "delete from posts where id=" . $_GET["deleteid"];
        $res = $mysqli->query($sql);

        if ($res) {
            echo "<h3>Deleted post: " . $_GET["deleteid"] . "</h3>";
        } else {
            die("failed to delete post");
        }
    }
}

function currentlyEditing() {
    if ($GLOBALS["postid"] !== "") {
        echo "<h3>Currently Editing Post id: " . $GLOBALS["postid"] . "</h3>";
    } else if ($GLOBALS["posttext"]) {
        echo "<h3>New Post Created!</h3>";
    } else {
        echo "<h3>New News Story</h3>";
    }
}

function isUpdate() {
    if ($GLOBALS["postid"] === "") {
        return 'false';
    } else {
        return 'true';
    }
}

function processParams() {
    include 'dbconnect.php';
    $sql = "";

    if (isset($_POST["posttext"])) {
        if (isset($_POST["postid"])) {
            if (is_int($postid = filter_input(INPUT_POST, 'postid', FILTER_VALIDATE_INT))) {
                //update existing post
                $sql = "UPDATE posts SET title='" . $_POST["title"] . "', posttext='" . $_POST["posttext"] . "' WHERE id=" . $_POST["postid"];
                
                $res = $mysqli->query($sql);
                
                // TODO: adapt all queries to prepared statements
                // $stmt = $mysqli->prepare("UPDATE  SET `field1` = 1 WHERE `key` = (?)")
                // $stmt->bind_param("s", $mykey);
                // $stmt->execute();

                // $nrows = $stmt->affected_rows;
                // if (!$nrows) {
                // }
                
                $GLOBALS["postid"]   = $_POST["postid"];
                $GLOBALS["title"]    = $_POST["title"];
                $GLOBALS["posttext"] = $_POST["posttext"];
                
            } else {
                //insert new post
                $sql = "INSERT INTO posts VALUES (NULL, '" . $_POST["title"] . "', '" . $_POST["posttext"] . "', NOW(), '')";
                $res = $mysqli->query($sql);

                if ($res) {
                    
                    $sql = "SELECT MAX(id) AS postid FROM posts"; // Select the post we just inserted
                    $res = $mysqli->query($sql);
                    $row = $res->fetch_assoc();
                    $GLOBALS["postid"] = $row["postid"];
                    $GLOBALS["title"]  = $_POST["title"];
                    $GLOBALS["posttext"] = $_POST["posttext"];
                } else {
                    die("failed to insert post");
                }
            }
        }
    } else if (isset($_GET["postid"])) {
        //edit existing post
        $sql = "SELECT id, title, posttext FROM posts WHERE id=" . $_GET["postid"];
        $res = $mysqli->query($sql);

        if ($res) {
            $row = $res->fetch_assoc();
            $GLOBALS["postid"]   = $row["id"];
            $GLOBALS["title"]    = isset($row["title"]) ? $row["title"] : "";
            $GLOBALS["posttext"] = $row["posttext"];
        } else {
            die("failed to load text for editing");
        }
    } else {
        $GLOBALS["title"] = "";
    }
}

function newsPostText() {
    if (isset($GLOBALS["posttext"]))
    echo $GLOBALS["posttext"];
}

function newsPostId() {
    echo $GLOBALS["postid"];
}

function titleText() {
    if (isset($GLOBALS["title"])) 
        echo $GLOBALS["title"];
}

function printArchiveBar() {
    include "../news/dbconnect.php";

    $sql = "SELECT * FROM posts ORDER BY dateposted DESC";
    $res = $mysqli->query($sql);

    if (!$res) {
        die($mysqli->error);
    }

    if ($res->num_rows == 0) {
        println("Table was empty.");
    }

    $years = array();
    $months = array();
    $year = "";
    $month = "";

    while ($row = $res->fetch_assoc()) {
        $dateposted = $row["dateposted"];
        $year = date("Y",  strtotime($dateposted));

        if (end($years) !== $year) {
            array_push($years, $year);
            println("</ul>" . $year  . "<ul>");
        }

        $month = date("F",  strtotime($dateposted));
        $month_num = date("m",  strtotime($dateposted));

        if (end($months) !== $month) {
            array_push($months, $month);
            println("<li><a href=\"archive_view.php?datetime=" . $dateposted . "&year=" . $year . "&month=" . $month_num . "\">" . $month . "</a></li>");
        }
    }
}

?>