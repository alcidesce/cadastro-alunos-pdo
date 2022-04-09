<?php

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:'.$caminhoBanco);

echo 'Conectado' . '<br><br>' ;

//$pdo->exec('CREATE TABLE STUDENTS (id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT);');