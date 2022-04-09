<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

require 'conexao.php';

$estudante = new Student(null, 'Alcides Alcoforado', new \DateTimeImmutable('1980-07-26'));

$sqlInsert = "INSERT INTO STUDENTS (name,birth_date) VALUES ('{$estudante->name()}','{$estudante->birthDate()->format('Y-m-d')}');";

//$sqlInsert = "DELETE FROM ESTUDANTE ";

var_dump($pdo->exec($sqlInsert));