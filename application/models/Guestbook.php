<?php

class Application_Model_Guestbook
{   
    protected $_id;
    protected $_email;
    protected $_comment;
    protected $_created; 

    public function __construct(array $options = NULL)
    {
        if(is_array($options))
            $this->setOptions($options);
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        return $this->$method();
    }
     
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($methods as $key => $value)
        {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods))
                $this->$method($value);
        }
        return $this;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function setEmail($email)
    {
        $this->_email = (string) $email;
        return $this;
    }

    public function setComment($text)
    {
        $this->_comment = (string) $text;
        return $this;
    }
    
    public function setCreated($ts)
    {
        $this->_created = $ts;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getComment()
    {
        return $this->_comment;
    }

    public function getCreated()
    {
        return $this->_created;
    }

}
