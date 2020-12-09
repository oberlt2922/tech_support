<?php
class Database {
    private $dsn, $username, $password, $options;
    
    public function __construct($dsn, $username, $password, $options) 
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->options = $options;
    }
    
    public function setDsn($dsn)
    {
        $this->dsn = $dsn;
    }
    
    public function getDsn()
    {
        return $this->dsn;
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setOptions($options)
    {
        $this->options = $options;
    }
    
    public function getOptions()
    {
        return $this->options;
    }
}
?>