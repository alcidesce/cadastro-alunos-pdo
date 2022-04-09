<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';
require 'conexao.php';

$statement = $pdo->query('SELECT * FROM STUDENTS;');

//var_dump($statement->fetchColumn(2)); exit();

/*while ($studentData = $statement->fetch(PDO::FETCH_ASSOC)){
    $student = new Student(
        $studentData['id'],
        $studentData['name'],
        new \DateTimeImmutable($studentData['birth_date'])
        );
    
    echo $student->age() . '<br>';
}
exit();*/

$studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);
$studentList = [];

foreach ($studentDataList as $studentData){
    $studentList[] = new Student(
        $studentData['id'], 
        $studentData['name'], 
        new \DateTimeImmutable($studentData['birth_date'])
        );
}

var_dump($studentList);