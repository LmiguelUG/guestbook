<?php

class Application_Model_GuestbookMapper
{
    protected $_dbTable;
    
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable))
            $dbTable = new $dbTable;

        if(!$dbTable instanceof Zend_Db_Table_Abstract)
            throw new Exception("Invalid table data gateway provided");

        $this->_dbTable = $dbTable;
        return $this;    
    }

    public function getDbTable() 
    {
        if (null === $this->_dbTable)
            $this->setDbTable('Application_Model_DbTable_Guestbook');

        return $this->_dbTable;
    }

    public function save(Application_Model_Guestbook $guestbook)
    {
        $data = array (
            'email' => $guestbook->getEmail(),
            'comment' => $guestbook->getComment(),
            'created' => date('Y-m-d H:i:s'),
        );

        if(null === ( $id = $guestbook->getId()))
        {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } 
        else 
        {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id)
    {
        $result = $this->getDbTable()->find($id);
        if($result == 0) 
            return;

        $row = $result->current();
        $guestbook = new Application_Model_Guestbook();
        $guestbook->setId($row->id)
                  ->setEmail($row->email)
                  ->setComment($row->comment)
                  ->setComment($row->created);
        return $guestbook;
    }

    public function fetchAll()
    {
        $results = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($results as $result) 
        {
            $obj = new Application_Model_Guestbook();
            $obj->setId($result->id)
                ->setEmail($result->email)
                ->setComment($result->comment)
                ->setCreated($result->created);

            $entries[] = $obj;
        }
        return $entries;
    }

}

