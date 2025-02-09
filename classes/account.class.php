<?php

require_once("dbh.class.php");

class Account extends Dbh {
    // Properties
    private $values = [];
    private $errors = [];

    // Constructor to initialize account properties
    public function __construct($firstName, $lastName, $email, $password, $password2) {
        $this->values = [
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $email,
            "password" => $password,
            "password2" => $password2
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
    private function validatePassword($password, $password2) {
        if (empty($password) || strlen($password) < 5 || strlen($password) > 40 || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $this->errors[] = "password";
        }
        if ($password !== $password2) {
            $this->errors[] = "password2";
        }
    }

    // Method to validate registration inputs
    public function validateRegister() {
        $this->validateName($this->values["firstName"], "firstName");
        $this->validateName($this->values["lastName"], "lastName");
        $this->validateEmail($this->values["email"]);
        $this->validatePassword($this->values["password"], $this->values["password2"]);

        if (empty($this->errors)) {
            $this->registerAccount();
            $this->setUserCookie();
            header("Location: ../index.php");
            exit();
        }
    }

    // Method to insert new account into the database
    private function registerAccount() {
        $stmt = $this->connect()->prepare("INSERT INTO users (firstName, lastName, email, password_txt) VALUES (?, ?, ?, ?)");
        $hashedPassword = password_hash($this->values["password"], PASSWORD_BCRYPT);
        $stmt->execute([$this->values["firstName"], $this->values["lastName"], $this->values["email"], $hashedPassword]);
    }

    // Method to set user cookie after registration
    private function setUserCookie() {
        $userId = $this->getUserId($this->values["email"]);
        setcookie("userID", $userId, time() + (86400 * 30), "/");
    }

    // Method to validate login inputs
    public function validateLogin() {
        $this->validateLoginEmail($this->values["email"]);
        $this->validateLoginPassword($this->values["password"]);

        if (empty($this->errors)) {
            $this->loginAccount();
        }
    }

    // Method to handle user login
    private function loginAccount() {
        $userData = $this->getUserData($this->values["email"]);
        setcookie("userID", $userData["userID"], time() + (86400 * 30), "/");

        if ($userData["isAdmin"] == 1) {
            setcookie("isAdmin", true, time() + (86400 * 30), "/");
        }
        header("Location: ../index.php");
        exit();
    }

    // Method to validate login email
    private function validateLoginEmail($email) {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$this->checkEmailExists($email)) {
            $this->errors[] = "email";
        }
    }

    // Method to validate login password
    private function validateLoginPassword($password) {
        $hashedPassword = $this->getHashedPassword();
        if (empty($password) || !password_verify($password, $hashedPassword)) {
            $this->errors[] = "password";
        }
    }

    // Method to fetch hashed password from the database
    private function getHashedPassword() {
        $stmt = $this->connect()->prepare("SELECT password_txt FROM users WHERE email = ?");
        $stmt->execute([$this->values["email"]]);
        return $stmt->fetch()["password_txt"] ?? '';
    }

    // Method to check if a certain error is present
    public function getError($error) {
        return in_array($error, $this->errors) ? "is-invalid" : "is-valid";
    }

    // Method to check if email exists in the database
    private function checkEmailExists($email) {
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    // Method to get user ID by email
    private function getUserId($email) {
        $stmt = $this->connect()->prepare("SELECT userID FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch()["userID"];
    }

    // Method to get user data by email
    private function getUserData($email) {
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // Method to return input values
    public function getValue($value) {
        return $this->values[$value];
    }
}

