<?php

namespace Alura\Pdo\infrastructure\Repository;

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use PDO;

$pdo = \Alura\Pdo\Infrastructure\Persistence\ConnectionCreator::createConnection();

class PdoStudentrepository implements StudentRepository
{
    private PDO $connection;
    
    public function __construct()
    {
        $this->connection = ConnectionCreator::createConnection();
    }
    
    public function studentsBirthAt(\DateTimeInterface $birthDate): array
    {
        $sqlQuery = 'SELECT * FROM students WHERE birth_date = ?;';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1,$birthDate->format('Y-m-d'));
        $stmt->execute();
        
        return $this->hydrateStudentList($stmt);
    }

    public function allStudents(): array
    {
        $sqlQuery = 'SELECT * FROM students;';
        $stmt = $this->connection->query($sqlQuery);
        
        return $this->hydrateStudentList($stmt);
    }
    
    private function hydrateStudentList(\PDOStatement $stmt): array
    {
        $studentDataList = $stmt->fetch(PDO::FETCH_ASSOC);
        $studentDataList = [];
        
        foreach ($studentDataList as $studentData){
            $studentDataList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new \DateTimeImmutable($studentData['birthDate'])
                );
        }
        
        return $studentDataList;
    }

    public function save(Student $student): bool
    {
        if ($student->id() === NULL){
            return $this->insert($student);
        }
        
        return $this->update($student);
    }
    
    public function insert(Student $student): bool
    {
        $insertQuery = 'INSERT INTO students (name,birth_date) VALUES (:name, :birth_date);';
        $stmt = $this->connection->prepare($insertQuery);
        
        $success = $stmt->execute([
            ':name' => $student->name(),
            ':birth_date' => $student->birthDate()->format('Y-m-d'),
        ]);
        
        if ($success){
            $student->defineID($this->connection->lastInsertId());
        }
        
        return $success;
    }
    
    public function update(Student $student): bool
    {
        $updateQuery = 'UPDATE students SET name = :name, birth_date = : birth_date WHERE id = :id;';
        $stmt = $this->connection->prepare($updateQuery);
        $stmt->bindValue(':name',$student->name());
        $stmt->bindValue(':birth_date',$student->birthDate()->format('Y-m-d'));
        $stmt->bindValue(':id', PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function remove(Student $student): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM students WHERE ID = ?');
        $stmt->bindvalue(1,$student->id(),PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}

