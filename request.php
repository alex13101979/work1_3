<?php
session_start();
require 'config.php';

use classes\Worker as UserWorker;

$checkError = 0;

if (!isset($_POST['user1salary']) || empty($_POST['user1salary'])) {
	$_POST['user1salary'] = 0;
} elseif ($_POST['user1salary'] < 0) {
	$checkError++;
	echo "<div style='margin-left:auto;margin-right:auto;font-family: sans-serif;max-width: 750px;max-height: 60px;margin-bottom: 35px;text-align: center;padding: 10px;border: 1px solid red; color: red;border-radius: 7px;text-align: center;'>Заплата первого сотрудника не может быть < 0!</div>";
}

if (!isset($_POST['user2salary']) || empty($_POST['user2salary'])) {
	$_POST['user2salary'] = 0;
} elseif ($_POST['user2salary'] < 0) {
	$checkError++;
	echo "<div style='margin-left:auto;margin-right:auto;font-family: sans-serif;max-width: 750px;max-height: 60px;margin-bottom: 35px;text-align: center;padding: 10px;border: 1px solid red; color: red;border-radius: 7px;text-align: center;'>Заплата второго сотрудника не может быть < 0!</div>";
}

if (!isset($_POST['user1name'],
	       $_POST['user2name']) ||
	empty($_POST['user1name']) ||
	empty($_POST['user2name'] )
){
	$checkError++;
	echo "<div style='margin-left:auto;margin-right:auto;font-family: sans-serif;max-width: 750px;max-height: 60px;margin-bottom: 35px;text-align: center;padding: 10px;border: 1px solid red; color: red;border-radius: 7px;text-align: center;'>Поля с именами всех сотрудников должны быть заполнены!</div>";
}

if (!isset($_SESSION['token'], $_POST['token'])
	|| empty($_SESSION['token'])
	|| empty($_POST['token'])
	|| ($_SESSION['token'] !== $_POST['token'])
) {
	$checkError++;
	echo "<div style='margin-left:auto;margin-right:auto;font-family: sans-serif;max-width: 750px;max-height: 60px;margin-bottom: 35px;text-align: center;padding: 10px;border: 1px solid red; color: red;border-radius: 7px;text-align: center;'>Не корректный токен!</div>";
}

if ($checkError === 0) {
	$userWorker1 = new UserWorker();
	$userWorker1->setName($_POST['user1name']);
	$userWorker1->setAge($_POST['user1age']);
	$age1 = $userWorker1->getAge();
	$userWorker1->setSalary($_POST['user1salary']);

	$userWorker2 = new UserWorker();
	$userWorker2->setName($_POST['user2name']);
	$userWorker2->setAge($_POST['user2age']);
	$age2 = $userWorker2->getAge();
	$userWorker2->setSalary($_POST['user2salary']);

	if ($age1 === 1000) {
		echo "<div style='margin-left:auto;margin-right:auto;font-family: sans-serif;max-width: 750px;max-height: 60px;margin-bottom: 35px;text-align: center;padding: 10px;border: 1px solid red; color: red;border-radius: 7px;text-align: center;'>Возраст первого сотрудника не в диапазоне от 0 до 100 лет!</div>";
	}

	if ($age2 === 1000) {
		echo "<div style='margin-left:auto;margin-right:auto;font-family: sans-serif;max-width: 750px;max-height: 60px;margin-bottom: 35px;text-align: center;padding: 10px;border: 1px solid red; color: red;border-radius: 7px;text-align: center;'>Возраст второго сотрудника не в диапазоне от 0 до 100 лет!</div>";
	}

	if (($age1 !== 1000) && ($age2 !== 1000)) {
		echo 'Сумма зарплат   ' . $userWorker1->getName() . ' и ' . $userWorker2->getName() . ': ' . ($userWorker1->getSalary() + $userWorker2->getSalary()) . "</br>";
		echo 'Сумма возрастов ' . $userWorker1->getName() . ' и ' . $userWorker2->getName() . ': ' . ($userWorker1->getAge() + $userWorker2->getAge()) . "</br>";
	}
}
