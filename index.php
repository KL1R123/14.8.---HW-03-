<?php
session_start();
require_once 'functions.php';

$currentUser = getCurrentUser();

if (!$currentUser) {
    header('Location: login.php');
    exit;
}

$loginTime = getLoginTime($currentUser);
$timeLeft = 86400 - (time() - $loginTime);
$hours = floor($timeLeft / 3600);
$minutes = floor(($timeLeft % 3600) / 60);
$seconds = $timeLeft % 60;

$birthdate = getBirthDate($currentUser);
$birthdateTimestamp = strtotime($birthdate);
$daysToBirthday = (strtotime($birthdate) - time()) / (60 * 60 * 24);

if ($daysToBirthday == 0){
  echo 'С Днем Рождения!';
} elseif($daysToBirthday > 0){
  echo 'До вашего дня рождения осталось ' . floor($daysToBirthday) . ' дней.<br>';
}else{
  echo 'Ваш день рождения уже прошел.<br>';
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Главная страница</title>
</head>
<body>
    <h1>Добро пожаловать, <?php echo $currentUser; ?>!</h1>
    <p>Ваша персональная скидка: 5%</p>
    <p>Осталось до истечения акции: <?php echo "$hours:$minutes:$seconds"; ?></p>
    <a href="logout.php">Выйти</a>
</body>
</html>