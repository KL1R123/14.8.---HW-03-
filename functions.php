<?php

function getUsersList(): array {
    $users = [];
    if (file_exists('users.json')) {
        $users = json_decode(file_get_contents('users.json'), true);
    }
    return $users;
}

function existsUser(string $login): bool {
    $users = getUsersList();
    return isset($users[$login]);
}

function checkPassword(string $login, string $password): bool {
    $users = getUsersList();
    if (existsUser($login)) {
        return password_verify($password, $users[$login]['password']);
    }
    return false;
}

function getCurrentUser(): ?string {
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
}

function setLoginTime(string $login){
  $users = getUsersList();
  $users[$login]['login_time'] = time();
  file_put_contents('users.json', json_encode($users));
}

function getLoginTime(string $login){
  $users = getUsersList();
  return $users[$login]['login_time'];
}

function getBirthDate(string $login){
  $users = getUsersList();
  return $users[$login]['birthdate'];
}

function setBirthDate(string $login, string $birthdate){
  $users = getUsersList();
  $users[$login]['birthdate'] = $birthdate;
  file_put_contents('users.json', json_encode($users));
}
?>