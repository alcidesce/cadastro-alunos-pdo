<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$pdo = Alura\Pdo\Infrastructure\Persistence\ConnectionCreator::createConnection();

$estudante = new Student(
    null, 
    'Rafaela Alcoforado', 
    new \DateTimeImmutable('2014-04-14')
    );

//$sqlInsert = "INSERT INTO STUDENTS (name,birth_date) VALUES ('{$estudante->name()}','{$estudante->birthDate()->format('Y-m-d')}');";

$sqlInsert = "INSERT INTO STUDENTS (name,birth_date) VALUES (:name,:birth_date);";
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(':name', $estudante->name());
$statement->bindValue(':birth_date', $estudante->birthDate()->format('Y-m-d'));

if ($statement->execute()){
    echo "Aluno incluido";
}

//$sqlInsert = "DELETE FROM ESTUDANTE ";

//var_dump($pdo->exec($sqlInsert));