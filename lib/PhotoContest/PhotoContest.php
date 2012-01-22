<?php

namespace PhotoContest;

class PhotoContest
{
    protected $_id;
    protected $_name;
    protected $_state;
    protected $_max_votes_first_rounds;
    protected $_max_votes_last_round;
    protected $_rounds;
    protected $_current_round;
    protected $_created_at;
    protected $_updated_at;

    protected $_options;
    protected $_errors;
    protected $_db;
    protected $_user;
    protected $_photos;
    
    public function __construct(Db $db, User $user, Photos $photos, $options)
    {
        $this->_db      = $db;
        $this->_user    = $user;
        $this->_photos  = $photos;
        $this->_options = $options;
        $this->_errors  = array();
    }

    public function queueError($error)
    {
        array_push($this->_errors, $error);
    }
    
    public static function loadConfig($db)
    {
        $sql = 'SELECT value FROM pc_options 
		WHERE pckey = "options"';
        $row = $db->query($sql);
        
        return unserialize($row['value']);
    }
    
    public static function saveConfig($db, $options)
    {
        $sql = 'UPDATE pc_options
            SET value = "' .  serialize($options) . '
            WHERE pckey = "options"
            ';
        $db->query($sql);
    }

    public function createFromForm()
    {
        $this->_id                      = false;
        $this->_name                    = $_POST['contest_name'];
        $this->_state                   = 'closed';
        $this->_max_votes_first_rounds  = (int)$_POST['max_votes_first_rounds'];
        $this->_max_votes_last_round    = (int)$_POST['max_votes_last_round'];
        $this->_rounds                  = (int)$_POST['contest_rounds'];
        $this->_current_round           = 0;
        $this->_created_at              = date('Y-m-d H:i:s');
        $this->_updated_at              = date('Y-m-d H:i:s');

        var_dump($this->saveContest());
    }

    public function saveContest()
    {
        if (is_numeric($this->_id)) {
            $this->_db->update(
                'pc_contests',
                array(
                    'id'                        => 'int',
                    'name'                      => 'string',
                    'state'                     => 'string',
                    'max_votes_first_rounds'    => 'int',
                    'max_votes_last_round'      => 'int',
                    'rounds'                    => 'int',
                    'current_round'             => 'int',
                    'created_at'                => 'string',
                    'updated_at'                => 'string'
                    ),
                array(
                    $this->_id,
                    $this->_name,
                    $this->_state,
                    $this->_max_votes_first_rounds,
                    $this->_max_votes_last_round,
                    $this->_rounds,
                    $this->_current_round,
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s')
                    ),
                array(
                    'id'
                    )
                );
             
            return $this->_id;    
        } else {            
            $this->_db->insert(
                'pc_contests',
                array(
                    'name'                      => 'string',
                    'state'                     => 'string',
                    'max_votes_first_rounds'    => 'int',
                    'max_votes_last_round'      => 'int',
                    'rounds'                    => 'int',
                    'current_round'             => 'int',
                    'created_at'                => 'string',
                    'updated_at'                => 'string'
                    ),
                array(
                    $this->_name,
                    $this->_state,
                    $this->_max_votes_first_rounds,
                    $this->_max_votes_last_round,
                    $this->_rounds,
                    $this->_current_round,
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s')
                    )
                );
            return $this->_db->insert_id();
        }
    }

    public function getContests()
    {
        $sql = '
            SELECT *
            FROM pc_contests
            ORDER BY id DESC
            ';

        return ($this->_db->queryAll($sql));
    }
}














































