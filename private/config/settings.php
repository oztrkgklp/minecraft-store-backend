<?php

  /* FUNCTIONS */
  function go($url) {
    header("Location: $url");
    exit();
  }

  function goDelay($url, $wait = 0) {
    return '<script type="text/javascript">setTimeout("location.href=\''.$url.'\';", '.($wait*1000).');</script>';
  }

  function alertSuccess($text, $padding = true) {
    if ($padding == false) {
      return '<div class="alert alert-success mb-0"><i class="fa fa-check-circle d-none d-md-inline-block"></i> '.$text.'</div>';
    }
    else {
      return '<div class="alert alert-success"><i class="fa fa-check-circle d-none d-md-inline-block"></i> '.$text.'</div>';
    }
  }

  function alertError($text, $padding = true) {
    if ($padding == false) {
      return '<div class="alert alert-danger mb-0"><i class="fa fa-times-circle d-none d-md-inline-block"></i> '.$text.'</div>';
    }
    else {
      return '<div class="alert alert-danger"><i class="fa fa-times-circle d-none d-md-inline-block"></i> '.$text.'</div>';
    }
  }

  function alertWarning($text, $padding = true) {
    if ($padding == false) {
      return '<div class="alert alert-warning mb-0"><i class="fa fa-bell d-none d-md-inline-block"></i> '.$text.'</div>';
    }
    else {
      return '<div class="alert alert-warning"><i class="fa fa-bell d-none d-md-inline-block"></i> '.$text.'</div>';
    }
  }

  function minecraftHeadURL($avatarAPI = 1, $username = null, $size = 20) {
    if ($avatarAPI == 1) {
      return "https://mc-heads.net/avatar/$username/$size.png";
    }
    else if ($avatarAPI == 2) {
      return "https://cravatar.eu/avatar/$username/$size.png";
    }
    else {
      return "https://mc-heads.net/avatar/$username/$size.png";
    }
  }

  function minecraftHead($avatarAPI = 1, $username = null, $size = 20, $extraClass = null) {
    $apiURL = minecraftHeadURL($avatarAPI, $username, $size);
    return '<img class="rounded-circle lazyload ' . $extraClass . '" data-src="' . $apiURL . '" src="/public/assets/img/loaders/head.png" alt="Oyuncu - ' . $username . '" width="' . $size . '" height="' . $size . '">';
  }

  function showEmoji($text) {
    $emojiPath = "/public/assets/img/emojis";
    $emojiText 	= array(
      ":D",
      ";)",
      ":)",
      "<3",
      ":(",
      ":O",
      ":o",
      ":P",
      ":')",
      ":8",
      "-_-",
      "(y)"
    );
    $emojiImage  = array(
      '<img src="'.$emojiPath.'/1.png" width="18px" />',
      '<img src="'.$emojiPath.'/2.png" width="18px" />',
      '<img src="'.$emojiPath.'/3.png" width="18px" />',
      '<img src="'.$emojiPath.'/4.png" width="18px" />',
      '<img src="'.$emojiPath.'/5.png" width="18px" />',
      '<img src="'.$emojiPath.'/6.png" width="18px" />',
      '<img src="'.$emojiPath.'/6.png" width="18px" />',
      '<img src="'.$emojiPath.'/7.png" width="18px" />',
      '<img src="'.$emojiPath.'/8.png" width="18px" />',
      '<img src="'.$emojiPath.'/9.png" width="18px" />',
      '<img src="'.$emojiPath.'/10.png" width="18px" />',
      '<img src="'.$emojiPath.'/11.png" width="18px" />'
    );
    return str_ireplace($emojiText, $emojiImage, $text);
  }

  function post($parameter) {
    if (isset($_POST[$parameter])) {
      return htmlspecialchars(trim(strip_tags($_POST[$parameter])));
    }
    else {
      return false;
    }
  }

  function get($parameter) {
    if (isset($_GET[$parameter])) {
      return strip_tags(trim(addslashes($_GET[$parameter])));
    }
    else {
      return false;
    }
  }

  function filteredContent($content) {
    $contentBadHTMLTags = array('<script>', '</script>');
    return str_replace($contentBadHTMLTags, '', $content);
  }

  function limitedContent($content, $limit = 0) {
    $newsContentLength = strlen($content);
    if ($newsContentLength > $limit) {
      return mb_substr($content, 0, $limit, 'utf-8').'...';
    }
    else {
      return $content;
    }
  }

  function verifiedCircle($permission) {
    if ($permission == 1) {
      return '<i class="fa fa-check-circle theme-color text-primary" data-toggle="tooltip" data-placement="top" title="Yönetici"></i>';
    }
     if ($permission == 2) {
      return '<i class="fa fa-check-circle theme-color text-primary" data-toggle="tooltip" data-placement="top" title="Moderatör"></i>';
    }
    if ($permission == 3) {
      return '<i class="fa fa-check-circle theme-color text-primary" data-toggle="tooltip" data-placement="top" title="Görevli" ></i>';
    }
    if ($permission == 4) {
      return '<i class="fa fa-check-circle theme-color text-primary" data-toggle="tooltip" data-placement="top" title="Yazar" ></i>';
    }
    if ($permission == 5) {
      return '<i class="fa fa-check-circle theme-color text-primary" data-toggle="tooltip" data-placement="top" title="Destek" ></i>';
    }
    if ($permission == 6) {
      return '<i class="fa fa-check-circle theme-color text-primary" data-toggle="tooltip" data-placement="top" title="YouTuber" ></i>';
    }
  }

  function permissionTag($permission) {
    if ($permission == 0) {
      return '<span class="badge badge-pill badge-secondary">Üye</span>';
    }
    else if ($permission == 1) {
      return '<span class="badge badge-pill badge-danger">Yönetici</span>';
    }
    else if ($permission == 2) {
      return '<span class="badge badge-pill badge-warning">Moderatör</span>';
    }
    else if ($permission == 3) {
      return '<span class="badge badge-pill badge-info">Görevli</span>';
    }
    else if ($permission == 4) {
      return '<span class="badge badge-pill badge-success">Yazar</span>';
    }
    else if ($permission == 5) {
      return '<span class="badge badge-pill badge-primary">Destek</span>';
    }
    else if ($permission == 6) {
      return '<span class="badge badge-pill badge-secondary">YouTuber</span>';
    }
    else {
      return '<span class="badge badge-pill badge-danger">HATA!</span>';
    }
  }

  function generateSalt($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
  }

  function createSHA256($password){
    $salt = generateSalt(16);
  	$hash = '$SHA$'.$salt.'$'.hash('sha256', hash('sha256', $password).$salt);
  	return $hash;
  }

  function checkSHA256($password, $realPassword){
  	$parts = explode('$', $realPassword);
  	$salt = $parts[2];
  	$hash = hash('sha256', hash('sha256', $password).$salt);
  	$hash = '$SHA$'.$salt.'$'.$hash;
  	return (($hash == $realPassword) ? true : false);
  }

  function checkUsername($username) {
    return preg_match("/[^a-zA-Z0-9_]/", $username);
  }

  function checkBadUsername($username = null, $list = array()) {
    foreach ($list as $badWord) {
      if (stristr($username, $badWord)) {
        return true;
      }
    }
    return false;
  }

  function checkEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $mailDomainWhitelist  = array(
        "yandex.com",
        "gmail.com",
        "hotmail.com",
        "hotmail.com.tr",
        "outlook.com",
        "outlook.com.tr",
        "aol.com",
        "icloud.com",
        "yahoo.com",
        "live.com",
        "mynet.com"
      );
      $mailExplode          = explode("@", $email);
      $mailDomain           = strtolower($mailExplode[1]);
      if (in_array($mailDomain, $mailDomainWhitelist)) {
        return false;
      }
      else {
        return true;
      }
    }
    else {
      return true;
    }
  }

  function checkBadPassword($password) {
    $badPasswordList = array(
      '1234',
      '12345',
      '123456',
      '1234567',
      '12345678',
      '123456789',
      '1234567890',
      'abc123',
      'xyz123',
      'qwerty',
      'qwerty123',
      'sifre',
      'sifre0',
      'sifre123',
      'password',
      'password0'
    );
    return in_array($password, $badPasswordList);
  }

  function getIP() {
    if (getenv("HTTP_CLIENT_IP")) {
      $ip = getenv("HTTP_CLIENT_IP");
    }
    else if (getenv("HTTP_X_FORWARDED_FOR")) {
      $ip = getenv("HTTP_X_FORWARDED_FOR");
      if (strstr($ip, ",")) {
        $tmp = explode (",", $ip);
        $ip = trim($tmp[0]);
      }
    }
    else {
      $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
  }

  function getDomain($url) {
    $url = strtolower((isset(parse_url($url)["host"])) ? $url : '//'.$url);
    $pieces = parse_url($url);
    if (isset($pieces['host'])) {
      if (substr($pieces['host'], 0, 4) == 'www.') {
        $pieces['host'] = substr($pieces['host'], 4);
      }
      return $pieces['host'];
    }
    return false;
  }

  function createDuration($duration = 0) {
    return date("Y-m-d H:i:s", (strtotime(date("Y-m-d H:i:s")) + ($duration * 86400)));
  }

  function getDuration($expiryDate = '1000-01-01 00:00:00') {
    return max(round((strtotime($expiryDate) - strtotime(date("Y-m-d H:i:s"))) / 86400), 0);
  }

  function createCookie($name = null, $value = null, $duration = 0, $sslStatus = false) {
    setcookie($name, $value, (time()+($duration * 86400)), '/', '', $sslStatus, true);
    return true;
  }

  function removeCookie($name = null) {
    if (isset($_COOKIE[$name])) {
      setcookie($name, "", (time()-(999 * 86400)), '/');
      return true;
    }
    else {
      return false;
    }
  }

  function convertURL($text) {
    $blackList = array("Ç", "Ş", "Ğ", "Ü", "İ", "Ö", "ç", "ş", "ğ", "ü", "ö", "ı", "-");
    $whiteList = array("c", "s", "g", "u", "i", "o", "c", "s", "g", "u", "o", "i", " ");
    $link = strtolower(str_replace($blackList, $whiteList, $text));
    $link = preg_replace("@[^A-Za-z0-9\-_]@i", " ", $link);
    $link = trim(preg_replace("/\s+/", " ", $link));
    $link = str_replace(" ", "-", $link);
    return $link;
  }

  function convertTime($time, $type = 0, $minute = false) {
    $time = strtotime($time);
    if ($type === 0) {
      $timeDifference = time() - $time;
      $second         = $timeDifference;
      $minute         = round($timeDifference/60);
      $hour           = round($timeDifference/3600);
      $day            = round($timeDifference/86400);
      $week           = round($timeDifference/604800);
      $month          = round($timeDifference/2419200);
      $year           = round($timeDifference/29030400);
      if ($second < 60) {
        if ($second === 0) {
          return 'Az önce';
        }
        else {
          return $second .' saniye önce';
        }
      }
      else if ($minute < 60) {
        return $minute .' dakika önce';
      }
      else if ($hour < 24) {
        return $hour.' saat önce';
      }
      else if ($day < 7) {
        return $day .' gün önce';
      }
      else if ($week < 4) {
        return $week.' hafta önce';
      }
      else if ($month < 12) {
        return $month .' ay önce';
      }
      else {
        return $year.' yıl önce';
      }
    }
    else if ($type === 1) {
      if ($minute === true) {
        return date("d.m.Y H:i", $time);
      }
      else {
        return date("d.m.Y", $time);
      }
    }
    else if ($type === 2) {
      if ($minute === true) {
        $date =  date('d.m.Y H:i', $time);
      }
      else {
        $date =  date('d.m.Y', $time);
      }
      $date   = explode('.', $date);
      $day    = $date[0];
      $month  = $date[1];
      $year   = $date[2];
      if ($month === '01') {
        $month = 'Ocak';
      }
      if ($month === '02') {
        $month = 'Şubat';
      }
      if ($month === '03') {
        $month = 'Mart';
      }
      if ($month === '04') {
        $month = 'Nisan';
      }
      if ($month === '05') {
        $month = 'Mayıs';
      }
      if ($month === '06') {
        $month = 'Haziran';
      }
      if ($month === '07') {
        $month = 'Temmuz';
      }
      if ($month === '08') {
        $month = 'Ağustos';
      }
      if ($month === '09') {
        $month = 'Eylül';
      }
      if ($month === '10') {
        $month = 'Ekim';
      }
      if ($month === '11') {
        $month = 'Kasım';
      }
      if ($month === '12') {
        $month = 'Aralık';
      }
      if ($minute === true) {
        $clock = explode(':', explode(' ', $year)[1]);
        $minute = $clock[0];
        $second = $clock[1];
        return sprintf("%02d %s %04d %02d:%02d", $day, $month, $year, $minute, $second);
      }
      else {
        return sprintf("%02d %s %04d", $day, $month, $year);
      }
    }
    else {
        return false;
    }
  }

  function convertNumber($number) {
    if ($number < 1000) {
      return number_format($number);
    }
    else if ($number < 100000) {
      return number_format($number / 1000, 1)." B";
    }
    else if ($number < 1000000) {
      return number_format($number / 1000)." B";
    }
    else if ($number < 1000000000) {
      return number_format($number / 1000000)." Mn";
    }
    else {
      return number_format($number / 1000000000)." Mr";
    }
  }

  function hashtag($content, $character, $url) {
    $content = str_replace('&#39;', '\'', $content);
    $pattern = "/".$character."+([0-9a-zA-ZÇŞĞÜÖİçşğüöı]+)/";
    $hashtag = preg_match_all($pattern, $content, $matches);
    if ($hashtag == true) {
      for ($i=0; $i < count($matches[0]); $i++) {
        $hashtagText = $matches[0][$i];
        $hashtagURL = $url."/".convertURL($matches[1][$i]);
        $replace = '<a href="'.$hashtagURL.'">'.$hashtagText.'</a>';
        $content = str_replace($hashtagText, $replace, $content);
      }
    }
    return $content;
  }

  function urlContent($content) {
    $pattern = "/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    $url = preg_match_all($pattern, $content, $matches);
    if ($url == true) {
      for ($i=0; $i < count($matches[0]); $i++) {
        $urlText = $matches[0][$i];
        $replace = '<a href="'.$urlText.'" target="_blank" rel="nofollow">'.$urlText.'</a>';
        $content = str_replace($urlText, $replace, $content);
      }
    }
    return $content;
  }

  require_once(__ROOT__."\private\config\connect.php");

  $settings = $db->query("SELECT * FROM Settings ORDER BY id DESC LIMIT 1");
  $readSettings = $settings->fetch();

  /* GENEL DEĞİŞKENLER */
  $serverIP         = $readSettings["serverIP"];
  $serverVersion    = $readSettings["serverVersion"];
  $serverName       = $readSettings["serverName"];
  $siteTitle        = $serverName.' - '.$readSettings["siteSlogan"];

  $siteURL = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on' ? "https" : "http")."://".$_SERVER["SERVER_NAME"]);

  $sslStatus = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" && $_SERVER["SERVER_PORT"] == 443;

  /* SSL */
  if ($readSettings["sslStatus"] == 1 && !$sslStatus) {
    header('HTTP/1.1 301 Moved Permanently');
    go('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
  }

  /* PHP Settings */
  if (function_exists("ini_set")) {
    ini_set('session.cookie_httponly', 'On');
  	if ($sslStatus) {
      ini_set('session.cookie_secure', 'On');
    }
  }

  session_start();
  ob_start();
  date_default_timezone_set("Europe/Istanbul");

  /* ACCOUNT PROCESS */
  if (isset($_COOKIE["rememberMe"]) || isset($_SESSION["login"])) {
    $loginToken = ((isset($_COOKIE["rememberMe"])) ? $_COOKIE["rememberMe"] : ((isset($_SESSION["login"])) ? $_SESSION["login"] : null));
    $admin = $db->prepare("SELECT A.*, ASe.loginToken, ANI.lastReadDate FROM Accounts A LEFT JOIN AccountNoticationInfo ANI ON A.id = ANI.accountID INNER JOIN AccountSessions ASe ON A.id = ASe.accountID WHERE A.permission IN (?, ?, ?, ?, ?) AND ASe.loginToken = ? AND ASe.creationIP = ? AND ASe.expiryDate > ?");
    $admin->execute(array(1, 2, 3, 4, 5, $loginToken, getIP(), date("Y-m-d H:i:s")));
    $readAdmin = $admin->fetch();
    $siteBannedStatus = $db->prepare("SELECT id FROM BannedAccounts WHERE accountID = ? AND categoryID = ? AND (expiryDate > ? OR expiryDate = ?)");
    $siteBannedStatus->execute(array($readAdmin["id"], 1, date("Y-m-d H:i:s"), '1000-01-01 00:00:00'));
    if ($admin->rowCount() > 0 && $siteBannedStatus->rowCount() == 0) {
      $_SESSION["login"] = $readAdmin["loginToken"];
      if (!isset($_COOKIE["rememberMe"])) {
        $updateAccountsSessions = $db->prepare("UPDATE AccountSessions SET expiryDate = ? WHERE accountID = ? AND loginToken = ?");
        $updateAccountsSessions->execute(array(createDuration(0.01666666666), $readAdmin["id"], $loginToken));
      }
      $onlineAccountsHistory = $db->prepare("SELECT * FROM OnlineAccountsHistory WHERE accountID = ?");
      $onlineAccountsHistory->execute(array($readAdmin["id"]));
      if ($onlineAccountsHistory->rowCount() > 0) {
        $updateOnlineAccountsHistory = $db->prepare("UPDATE OnlineAccountsHistory SET expiryDate = ?, creationDate = ? WHERE accountID = ?");
        $updateOnlineAccountsHistory->execute(array(createDuration(0.00347222222), date("Y-m-d H:i:s"), $readAdmin["id"]));
      }
      else {
        $insertOnlineAccountsHistory = $db->prepare("INSERT INTO OnlineAccountsHistory (accountID, expiryDate, creationDate) VALUES (?, ?, ?)");
        $insertOnlineAccountsHistory->execute(array($readAdmin["id"], createDuration(0.00347222222), date("Y-m-d H:i:s")));
      }
    }
    else {
      removeCookie("rememberMe");
      session_destroy();
      go("/giris-yap");
    }
  }
  else {
    removeCookie("rememberMe");
    session_destroy();
    go("/giris-yap");
  }

?>