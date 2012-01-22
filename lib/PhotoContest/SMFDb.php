<?php

namespace PhotoContest;

class SMFDb implements Db
{
    protected $_smcFunc;
    protected $_result;
    
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
        
        $this->_result = $smcFunc['db_query']('', $sql);
        
        return $smcFunc['db_fetch_assoc']($this->_result);
    }

    public function queryAll($sql)
    {
        $smcFunc = $this->_smcFunc;
        
        $this->_result = $smcFunc['db_query']('', $sql);
        
        while ($rows[] = $smcFunc['db_fetch_assoc']($this->_result));

        return $rows;
    }

    public function insert($tableName, $dataTypes, $data)
    {
        $smcFunc = $this->_smcFunc;

        return $smcFunc['db_insert'](
            'insert',
            $tableName,
            $dataTypes,
            $data,
            array()
            );
    }

    public function update($tableName, $dataTypes, $data, $keys)
    {
        $smcFunc = $this->_smcFunc;

        return $smcFunc['db_insert'](
            'insert',
            $tableName,
            $dataTypes,
            $data,
            $keys
            );
    }

    public function insert_id()
    {
        $smcFunc = $this->_smcFunc;

        return $smcFunc['db_insert_id']('');
    }
    
}