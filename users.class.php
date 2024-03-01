<?php 
include 'dbh.class.php';

class User extends Dbh {
    private $email;
    private $firstName;
    private $lastName;
    private $pass;

    public function __construct($email, $firstName, $lastName, $pass) {
        //setting the properties
        $this->email=$email;
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->pass=$pass;
    }

    public function signupUser() {
        $error="";
        if($this->emptyInputs() == false)
        {
            //echo empty input!
            $error ="Please make sure all fields are filled";
        }
        if($this->invalidName($this->firstName)) 
        {
            $error = "invalid first name";
        }
        if($this->invalidName($this->lastName)) 
        {
            $error = "invalid last name";
        }
        if($this->invalidemail() == false) 
        {
            $error = "Invalid email!";
        }
        if($error =="")
        {
            $this->addUser();
        }
        else
        {
            echo $error;
        }
    }

    private function filterByEmail(){

        //prepare the statement
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE email = ?');

        if(!$stmt->execute(array($this->email)))
        {
            $stmt = null;
        }
        else
        {
            return $stmt->fetchAll();
        }
    }
       
    public function checkLogin() 
    {
        $rows = $this->filterByEmail();
        echo $this->pass;

        if (count($rows) == 1) 
        {
            if(password_verify($this->pass, $rows[0]['password_text'])) 
            {
                return $rows[0];
            }
        }
    }
    //Validation Methods
    //private methods

    //Check if empty
    private function emptyInputs() 
    {
        $result="";
        if(empty($this->firstName) || 
            empty($this->lastName) || 
            empty($this->email) || 
            empty($this->pass)) 
        {
            $result = false;
        }
        else
        {
            $result=true;
        }
        
        return $result;
    }

    //check for invalid characters
    private function invalidName($name)
    {
        $result ="";
        if (strlen($name) < 3 || strlen($name) > 14) 
        {
            $result = "Name has to be between 3 and 14 characters!";
        } 
        else
        {
            for($i=0;$i<strlen($name);$i++)
            {
                if(ctype_punct($name[$i])) 
                {
                    $result = "Name can not contain punctuation!";
                    break;
                }
                if(ctype_digit($name[$i]))
                {
                    $result = "Name can not contain digits!"; 
                    break;
                }
            }
        }
        echo $result;
        return $result;
    }

    //filter email
    private function invalidEmail() 
    {
        $result="";
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else{
            $result = true;
        }
        return $result;
    }


    private function addUser()
    {
        $stmt = $this->connect()->prepare('INSERT INTO users(first_name, last_name, email, password_text) VALUES (?,?,?,?)');
        
        $hashedPwd = password_hash($this->pass, PASSWORD_DEFAULT);
        if(!$stmt->execute([$this->firstName, $this->lastName, $this->email, $hashedPwd]))
        {
            $stmt = null;
            header("location:index.php?error=stmtfailed");
            exit();
        }
        else
        {
            echo "added";
        }
    }

    //get the user from the users table
    public function getUser($user_id)
    {
        //prepare statement to find the user
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE user_id = ?;');

        if(!$stmt->execute(array($user_id))) 
        {
            echo 'stmt failed';
            $stmt = null;
            exit();
        }
        else 
        {
            echo 'stmt executed';
            return $stmt->fetchAll();
        }
    }
}