<?php

namespace PhotoContest;

class PhotoContest
{
    protected $options;
    protected $errors;
    
    public function __construct(Db $db, User $user, Photos $photos)
    {
        $this->options  = self::loadConfig($db);
        $this->errors   = array();
    }

    public function queueError($error)
    {
        array_push($this->errors, $error);
    }
    
    public static function loadConfig($db)
    {
        $sql = "SELECT valor FROM fcalendario_opciones
		WHERE opcion = 'options'";
        $row = $db->query($sql);
        
        return unserialize($row["valor"]);
    }
    
    public static function saveConfig($db, $options)
    {
        $sql = "UPDATE fcalendario_opciones 
            SET valor = '".  serialize($options)."'
            WHERE opcion = 'options'
            ";
        $db->query($sql);
    }
}