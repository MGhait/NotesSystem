<?php
class Connection
{
    public PDO $pdo;
    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3308;dbname=note_system1', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function uidExists($username,$email) {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE usersUid = :usersUid OR usersEmail = :usersEmail");
        if (!$statement) {
            header('Location: ../signup.php?error=stmfaild');
            exit();
        }
        $statement->bindValue('usersUid', $username);
        $statement->bindValue('usersEmail', $email);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row;
        } else {
            return false;
        }
    }
    public function loginUser($username, $pwd) {
        $uidExists = $this->uidExists($username, $username);

        if ($uidExists === false) {
            header("Location: ../login.php?error=wornglogin");
            exit();
        }

        $pwdHashed = $uidExists['usersPwd'];
        $checkPwd = password_verify($pwd, $pwdHashed);

        if ($checkPwd === false) {
            header("Location: ../login.php?error=wornglogin");
            exit();
        } else {
            session_start();
            $_SESSION['userid'] = $uidExists['usersId'];
            $_SESSION['username'] = $uidExists['usersName'];
            $_SESSION['useruid'] = $uidExists['usersUid'];
            header("Location: ../index.php");
            exit();
        }
    }
    public function createUser($name, $email, $username, $pwd) {
        $statement = $this->pdo->prepare("INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES  (:usersName, :usersEmail, :usersUid, :usersPwd);");
        if (!$statement) {
            header('Location: ../signup.php?error=stmfaild');
            exit();
        }
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $statement->bindValue('usersName',$name);
        $statement->bindValue('usersEmail',$email);
        $statement->bindValue('usersUid',$username);
        $statement->bindValue('usersPwd',$hashedPwd);
        $statement->execute();

        header("Location: ../signup.php?error=none");
        exit();
    }


    public function getNotes($userId)
    {
        $statement = $this->pdo->prepare("SELECT * FROM notes WHERE usersId = :userId ORDER BY date DESC ");
        $statement->bindValue('userId', $userId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addNote($userId,$note)
    {
        $statement = $this->pdo->prepare("INSERT INTO notes (notesTitle, notesDescription, date, usersId)
                                    VALUES (:notesTitle, :notesDescription, :date, :userId)");

        $statement->bindValue('notesTitle', $note['notesTitle']);
        $statement->bindValue('notesDescription', $note['notesDescription']);
        $statement->bindValue('date', date('Y-m-d H:i:s'));
        $statement->bindValue('userId', $userId);

        return $statement->execute();
    }
    public function getNoteById($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM notes WHERE notesId = :id");
        $statement->bindValue('id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function updateNote($id, $note)
    {
        $statement = $this->pdo->prepare("UPDATE `notes` SET `notesTitle` = :title, `notesDescription` = :descript WHERE `notesId` = :id");
        $statement->bindValue('id', $id);
        $statement->bindValue('title', $note['notesTitle']);
        $statement->bindValue('descript', $note['notesDescription']);

        return $statement->execute();
    }
    public function removeNote($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM notes WHERE notesId=:id");
        $statement->bindValue('id', $id);
        return $statement->execute();
    }
}

return new connection();
