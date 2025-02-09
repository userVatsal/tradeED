<?php

require_once("dbh.class.php");

class Profile extends Dbh {
    // Properties
    private $id;
    private $values = [];
    private $errors = [];

    // Constructor to initialize profile properties
    public function __construct($id, $firstName, $lastName, $email, $password, $password2) {
        $this->id = $id;
        $this->values = [
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $email,
            "password" => $password,
            "password2" => $password2,
        ];
    }

    // Method to validate names
    private function validateName($name, $type) {
        if (empty($name) || strlen($name) < 3 || strlen($name) > 20 || !ctype_alpha($name)) {
            $this->errors[] = $type;
        }
    }

    // Method to validate email
    private function validateEmail($email) {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $this->checkEmailExists($email)) {
            $this->errors[] = "email";
        }
    }

    // Method to validate password
    public function validatePassword() {
        if (empty($this->values["password"]) || strlen($this->values["password"]) < 5 || strlen($this->values["password"]) > 40 || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $this->values["password"])) {
            $this->errors[] = "password";
        }
        if ($this->values["password"] !== $this->values["password2"]) {
            $this->errors[] = "password2";
        }

        if (empty($this->errors)) {
            $this->updatePassword($this->values["password"]);
            header("Location: ?message=success");
            exit();
        }
    }

    // Method to validate profile update inputs
    public function validateUpdate() {
        $this->validateName($this->values["firstName"], "firstName");
        $this->validateName($this->values["lastName"], "lastName");
        $this->validateEmail($this->values["email"]);

        if (empty($this->errors)) {
            $this->updateInfo($this->values["firstName"], $this->values["lastName"], $this->values["email"]);
            header("Location: ?message=success");
            exit();
        }
    }

    // Method to update basic information in the database
    private function updateInfo($firstName, $lastName, $email) {
        $stmt = $this->connect()->prepare("UPDATE users SET firstName = ?, lastName = ?, email = ? WHERE userID = ?");
        $stmt->execute([$firstName, $lastName, $email, $this->id]);
    }

    // Method to update password in the database
    private function updatePassword($password) {
        $stmt = $this->connect()->prepare("UPDATE users SET password_txt = ? WHERE userID = ?");
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt->execute([$hashedPassword, $this->id]);
    }

    // Method to check if a certain error is present
    public function getError($error) {
        return in_array($error, $this->errors) ? "is-invalid" : "is-valid";
    }

    // Method to check if email exists in the database
    private function checkEmailExists($email) {
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email = ? AND userID != ?");
        $stmt->execute([$email, $this->id]);
        return $stmt->rowCount() > 0;
    }

    // Method to fetch account data based on ID
    private function getData() {
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE userID = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetch();
    }

    // Method to return input values
    public function getValue($value) {
        $data = $this->getData();
        $data['password'] = $data['password_txt'];
        unset($data['password_txt']);

        if (empty($this->values[$value]) && $value !== "password2" && $value !== "password") {
            return $data[$value];
        } elseif (($value == "password2" || $value == "password") && empty($this->values[$value])) {
            return "";
        } else {
            return $this->values[$value];
        }
    }

    // Method to delete account from the database
    public function deleteAccount() {
        $stmt = $this->connect()->prepare("DELETE FROM users WHERE userID = ?");
        $stmt->execute([$this->id]);
    }
}

