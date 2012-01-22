<?php

namespace PhotoContest;

class SMFDb implements Db
{
    protected $_smcFunc;
    
    public function __construct($smcFunc) {
        $this->_smcFunc = $smcFunc;
    }
    
    /**
     * Returns associative array from $sql query
     * @param string $sql
     * @return array
     */
    public function query($sql)
    {
        $smcFunc = $this->_smcFunc;
        
        $result = $smcFunc['db_query']('', $sql);
        
        return $smcFunc['db_fetch_assoc']($result);
    }
    
}