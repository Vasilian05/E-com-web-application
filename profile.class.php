<?php 
include 'dbh.class.php';

class Profile extends Dbh {
    
    private $email;
    private $firstName;
    private $lastName;

    //SETTERS

    //set email
    public function setEmail($email) 
    {
        $this->email=$email;
    }
    //set first name 
    public function setFirstName($firstName) 
    {
        $this->firstName=$firstName;
    }
    //set last name 
    public function setLastName($lastName) 
    {
        $this->lastName=$lastName;
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
            return $stmt->fetchAll();
        }
    }

    public function updateDetails() 
    {
        $error="";
        if($this->emptyInputs() == false) 
        {
            //echo empty input!
            $error ="Please make sure all fields are filled";
        }

        if($this->invalidName($this->firstName)) 
        {
            $error = "invalid last name";
        }
        
        if($this->invalidName($this->lastName)) 
        {
            $error = "invalid last name";
        }
        
        if(!$this->invalidemail() == "") 
        {
            $error = "Invalid email!";
        }
        if($error =="")
        {
            $this->Update();
        }
        else
        {
            echo $error;
        }
    }

    // Validation 

    //filter email
    private function invalidEmail() 
    {
        $result="";
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) 
        {
            $result = "Invalid email!";
        }

        return $result;
    }

    //check for invalid characters
    private function invalidName($name)
    {
        $result = "";
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

        return $result;
    }

    //Check if empty
    private function emptyInputs() 
    {
        $result="";

        $result = true;

        if(empty($this->firstName) || empty($this->lastName) || empty($this->email)) 
        {
            $result = false;
        }

        return $result;
    }

    private function Update(){

        $stmt = $this->connect()->prepare('UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE user_id = ?;');

        if(!$stmt->execute([$this->firstName, $this->lastName, $this->email, $_COOKIE['userid']]))
        {
            echo 'update unsuccessful';
            $stmt = null;
            exit();
        }
        else 
        {
            echo 'update successful';
        }
    }
}