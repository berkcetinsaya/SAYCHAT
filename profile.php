<?php
$page_title = "Profile";
error_reporting(0);
include('session.php');
if ($db->connect_errno > 0) {
  die('Unable to connect to database [' . $db->connect_error . ']');
}
$result = $db->query("select * from user where username='$_SESSION[login_user]'");
while ($row = $result->fetch_assoc()) {
  $user_id[]  = $row['id'];
  $username   = $row['username'];
  $fname      = $row['fname'];
  $lname      = $row['lname'];
  $email      = $row['email'];
  $type       = $row['type'];
  $picture    = $row['picture'];
}

$result->free();

$result = $db->query("select * from path");
while ($row = $result->fetch_assoc()) {
  $encrypt  = $row['name'];
  $time   = $row['time'];
}
$encryp = explode(",", $encrypt);
function multiexplode($delimiters, $string)
{
  $ready = str_replace($delimiters, $delimiters[0], $string);
  $launch = explode($delimiters[0], $ready);
  return  $launch;
}
$txt = "";
$letter = array(
  'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K',
  'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'V', 'Y', 'Z', 'W',
  'Q', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ':', ';',
  '(', ')', 'X', ' ', '.', '?', ',', '!', '-', '<', '>', '\'', '"'
); //50

date_default_timezone_set('Europe/Istanbul');

$query  = "SELECT NOW() as `now`";
$result = $db->query($query);
$row    = $result->fetch_array();
$now    = $row['now'];

$old_date_timestamp = strtotime($now);
$new_date = date('Ymd', $old_date_timestamp);

if ($time != $new_date) {
  foreach ($encryp as $key => $value) {
    if ($key < 36) {
      $a = $key + 13;
    } else {
      $a = $key - 37;
    }
    $en[$a] = $encryp[$key];
  }
  $encryp = $en;
  ksort($encryp);
  $txt = implode(",", $encryp);

  $sql43 = "DELETE FROM `user_entry` ";
  if ($db->query($sql43)) { }
  $sql4 = "DELETE FROM `entries` ";
  if ($db->query($sql4)) { }
  $sql42 = "DELETE FROM `path` ";
  if ($db->query($sql42)) { }

  $sql = "INSERT INTO `path`(`id`,`name`, `time`) VALUES (NULL,'{$txt}','{$new_date}')";
  if ($db->query($sql)) { }
}

if (isset($_POST['sub'])) {
  if (!empty($_POST['text'])) {
    $text = strtoupper($_POST['text']);
    $seperatedText = explode(" ", $text);
    foreach ($seperatedText as $key => $value) {  //  0=>'BERK',1=>'CETINSAYA'
      for ($i = 0; $i < strlen($value); $i++) {
        $a = $value[$i];
        $letterKey = array_search($a, $letter);
        $chr = $encryp[$letterKey];
        $value[$i] = $chr;

        $c = ord($value[$i]);
        $d = decbin($c);
        if ($i < strlen($value) - 1) {
          $worden[] = $d . '&';
        } else {
          $worden[] = $d;
        }
      }
      if ($key < sizeof($seperatedText) - 1) {
        $worden[] = "&`&";
      }
    }
    $worden = implode($worden);

    $sql = "INSERT INTO `entries`(`entry`) VALUES ('{$worden}')";
    if ($db->query($sql)) { }
    $sql000 = "SELECT id FROM entries ORDER BY id DESC LIMIT 1";
    if (!$result = $db->query($sql000)) {
      die('There was an error running the query [' . $db->error . ']');
    }
    while ($row = $result->fetch_assoc()) {
      $last_row[] = $row['id'];
    }
    $result->free();
    $sql00 = "INSERT INTO `user_entry`(`user_id`, `entry_id`) VALUES ('{$user_id[0]}','{$last_row[0]}')";
    if ($db->query($sql00)) { }
  }
} else if (isset($_POST['bus'])) {
  if (!empty($_POST['text'])) {

    $text = strtoupper($_POST['text']);
    $seperatedText = multiexplode(array("&"), $text);
    foreach ($seperatedText as $key => $value) {  //  0=>'BERK',1=>'CETINSAYA'
      if ($value != '`') {
        $as = bindec($value);
        $s = chr($as);
        for ($i = 0; $i < strlen($s); $i++) {
          $a = $s[$i];
          $letterKey = array_search($a, $encryp);
          $chr = $letter[$letterKey];
          $s[$i] = $chr;
        }
        $wordinsert[] = $s;
      } else {
        $wordinsert[] = ',';
      }
    }
    $wordinsert = implode($wordinsert);
    $wordinsert = multiexplode(array(","), $wordinsert);
    $wordinsert = implode(" ", $wordinsert);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>SayChat</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="clipboard/dist/clipboard.min.js"></script>
  <style>
    html {
      position: relative;
      min-height: 100%;
      word-wrap: break-word;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {
      height: auto
    }

    /* Set gray background color and 100% height */
    .sidenav {
      
      background-color: #f1f1f1;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      position: fixed;
      background-color: #555;
      color: white;
      padding: 15px;
      bottom: 0;
      width: 100%;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }

      .row.content {
        height: auto;
      }
    }
  </style>
</head>

<body style="background-color: silver;">
  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 sidenav">
        <h4>SayChat</h4>
        <ul class="nav nav-pills nav-stacked">
          <li class="active"><a href="index.php"><?php echo ucfirst($fname) . " " . ucfirst($lname) ?></a></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a></li>
        </ul><br><br><br>
        <form class="form-horizontal" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="form-group">
            <textarea name="text" style="resize:none;" class="form-control" autofocus required rows="5" placeholder="Entry .."></textarea>
          </div>
          <div class="form-group" align="center">
            <button name="sub" type="submit" class="btn-default btn-lg"><span class="glyphicon glyphicon-lock"></span></button>
            <button name="bus" type="submit" class="btn-info btn-lg"><span class="glyphicon glyphicon-link"></span></button>
          </div>
        </form>
        <?php if (isset($_POST['bus'])) { ?>
          <div class="panel panel-default">
            <div class="panel-heading">Output</div>
            <?php echo '<div id="ekran" class="panel-body">' . $wordinsert . '</div>'; ?>
          </div>
        <?php } ?>
      </div>
      <div class="col-sm-9">
        <h4><small>RECENT POSTS</small></h4>
        <hr>

        <?php
        $sql = "SELECT * FROM entries ORDER BY time DESC";
        if (!$result = $db->query($sql)) {
          die('There was an error running the query [' . $db->error . ']');
        }
        while ($row = $result->fetch_assoc()) {
          $entry_id[]       = $row['id'];
          $entry[]          = $row['entry'];
          $entry_time[]     = $row['time'];
        }
        $result->free();

        foreach ($entry as $id => $entryy) {
          $sql = "SELECT * FROM `user` WHERE id in(select user_id from user_entry where entry_id='{$entry_id[$id]}')";
          if (!$result = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
          }
          $entry_pic = array();
          $entry_firstname = array();
          $entry_lastname = array();
          while ($row = $result->fetch_assoc()) {
            $entry_firstname[] = $row['fname'];
            $entry_lastname[] = $row['lname'];
            $entry_pic[]    = $row['picture'];
          }
          $result->free();
          echo ' 
        <div class="row">
        <div class="col-sm-2 text-center">
        <img src="data:image;base64,' . $entry_pic[0] . '" class="img-circle" height="65" width="65" alt="Avatar">
      </div>
      <div class="col-sm-10">
        <h4>' . ucfirst($entry_firstname[0]) . " " . ucfirst($entry_lastname[0])  . ' <small>' . $entry_time[$id] . '</small></h4>
        <button id="cpy" class="btn-primary btn-lg btn-block" data-clipboard-action="copy" data-clipboard-target="#p' . $id . '"><span class="glyphicon glyphicon-copy"></span> Copy to Clipboard</button>
        <br>
        <div id="p' . $id . '">' . $entryy . '</div><br>
      </div>
    </div>
    <hr>
    ';
        }
        ?>
      </div>
    </div>
  </div>
  <?php include_once "footer.php"; ?>