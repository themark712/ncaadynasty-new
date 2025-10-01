<?php
$filepath = "";

if (strpos($_SERVER['REQUEST_URI'], "admin") > 0 || strpos($_SERVER['REQUEST_URI'], "edit") > 0) {
    $filepath = "../";
}

function query(string $query, array $data = [])
{
    $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
    $conn = new PDO($string, DBUSER, DBPASS);

    $stm = $conn->prepare($query);
    $stm->execute($data);

    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    if (is_array(($result)) && !empty($result)) {
        return $result;
    }
    //echo $query;
    return false;
}

function ins_query(string $query, array $data = [])
{
    $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
    $conn = new PDO($string, DBUSER, DBPASS);

    $stm = $conn->prepare($query);
    $stm->execute($data);
    $result = $conn->lastInsertId();

    if (!empty($result)) {
        return $result;
    }

    return false;
}

function redirect($page)
{
    header('Location: ' . $page);
    die;
}

function old_value($key, $default = '')
{
    if (!empty($_POST[$key])) {
        return $_POST[$key];
    }
    return $default;
}


function playerIsDynastyOwner($did, $userid)
{
    $isOwner = false;

    $sql = "SELECT * FROM dynasty WHERE id=" . $did;

    $league = query($sql);

    foreach ($league as $row) {
        if ($row["userid"] == $userid) {
            $isOwner = true;
        }
    }
    return $isOwner;
}

function getRanking($conn, $tid)
{
    $sql = "SELECT * FROM ncaateams ORDER BY fbrank DESC";

    $rankings = $conn->query($sql, MYSQLI_STORE_RESULT);
    $rowcount = mysqli_num_rows($rankings);

    $i = 0;
    while ($row = mysqli_fetch_array($rankings)) {
        $i++;
        if ($row["id"] == $tid) {
            return $i;
        }
    }

    return "";
}

function getUserId($conn, $name)
{
    $id = 0;
    $sql = "SELECT id FROM ncaauser WHERE username='" . $name . "'";
    $user = $conn->query($sql, MYSQLI_STORE_RESULT);

    while ($row = mysqli_fetch_array($user)) {
        $id = $row["id"];
    }

    return $id;
}

function getUsername($id)
{
    $name = 0;
    $sql = "SELECT username FROM dynuser WHERE id=" . $id;
    $user = query($sql);

    if ($user) {
        foreach ($user as $row) {
            $name = $row["username"];
        }
    }

    return $name;
}

function getDynastyOwner($dynid)
{
    $userid = 0;

    $query = "SELECT * FROM dynasty WHERE id=" . $dynid;
    $result = query($query);

    if ($result) {
        foreach ($result as $row) {
            $userid = $row["userid"];
        }
    }

    return $userid;
}

function getDynastyName($id)
{
    $name = "";
    $query = "SELECT * FROM dynasty WHERE id=" . $id;
    $result = query($query);

    if ($result) {
        foreach ($result as $row) {
            $name = $row["name"];
        }
    }

    return $name;
}

function getDynastyIdFromSeason($seasonId)
{
    $dynid = 0;
    $query = "SELECT dynastyid FROM dynseasons WHERE id=" . $seasonId;
    $result = query($query);

    if ($result) {
        foreach ($result as $row) {
            $dynid = $row["dynastyid"];
        }
    }

    return $dynid;
}

function getTeamIdFromDynasty($dynid)
{
    $teamid = 0;
    $query = "SELECT teamid FROM dynseasons WHERE dynastyid=" . $dynid . " AND id IN (SELECT activeseason FROM dynasty WHERE id=" . $dynid . ") LIMIT 1";
    $result = query($query);
    //echo $query;
    if ($result) {
        foreach ($result as $row) {
            $teamid = $row["teamid"];
        }
    }

    return $teamid;
}

function getCurrentSeasonId($dynid) {
    $seasonid = 0;
    $query = "SELECT activeseason FROM dynasty WHERE id=" . $dynid . " LIMIT 1";
    $result = query($query);
    //echo $query;
    if ($result) {
        foreach ($result as $row) {
            $seasonid = $row["activeseason"];
        }
    }

    return $seasonid;
}

function getConfid($seasonid, $teamid)
{
    $confid = 0;
    $query = "SELECT newconfid FROM dyncustomconf WHERE seasonid=" . $seasonid . " AND newteamid=" . $teamid;
    $result = query($query);

    if ($result) {
        foreach ($result as $row) {
            $confid = $row["newconfid"];
        }
    } else {
        $query = "SELECT confid FROM dynteams WHERE id=" . $teamid;
        $result = query($query);

        if ($result) {
            foreach ($result as $row) {
                $confid = $row["confid"];
            }
        }
    }

    return $confid;
}

function getConfTeamIdList($currentSeason, $conf) {
    //$conf = getConfid($currentSeason, $userTeamId);
    $sql = "SELECT t.id FROM dynteams t LEFT JOIN dynconf c ON t.confid=c.id ";
    $sql .= " WHERE t.confid = " .  $conf;
    $sql .= " AND t.id NOT IN (SELECT replacedteamid FROM dyncustomconf WHERE confid=" . $conf . " AND seasonid=" . $currentSeason . ")";
    $sql .= " UNION ";
    $sql .= " SELECT t.id FROM dynteams t LEFT JOIN dynconf c ON t.confid=c.id WHERE t.id IN (SELECT newteamid FROM dyncustomconf WHERE confid=" . $conf . " AND seasonid=" . $currentSeason . ") ";
    
    $result = query($sql);

    if($result) {
        foreach($result as $row) {
            $ary[]=$row["id"];
        }
    }

    return $ary;
}
