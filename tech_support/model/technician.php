<?php
class Technician {
    private $techID, $firstName, $lastName, $email, $phone, $password;
    
    public function __construct($firstName, $lastName, $email, $phone, $password, $techID = NULL)
    {
        $this->techID = $techID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }
    
    public function setTechID($techID)
    {
        $this->techID = $techID;
    }
    
    public function getTechID()
    {
        return $this->techID;
    }
    
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    
    public function getLastName()
    {
        return $this->lastName;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
    public function getPhone()
    {
        return $this->phone;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getFullName()
    {
        $fullName = $this->firstName . " " . $this->lastName;
        return $fullName;
    }
}
?>