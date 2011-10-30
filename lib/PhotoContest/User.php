<?php

namespace PhotoContest;

abstract class User
{
    protected $_id;
    protected $_name;
    protected $_isGuest;
    protected $_isAdmin;
    protected $_picturesUploaded;
    protected $_votes;
    protected $_db;
    protected $_options;
    
    //TODO: Cambiar los nombres de los campos de la BD, id_member -> user_id, anyo -> contest...
    public function __construct($options) 
    {
        $sql = 'SELECT count(*) as total FROM fcalendario_fotos
            WHERE   id_member   =  '.$this->_id.'
            AND     anyo        = "'.$this->_options['actualContest'].'"';
        $row = $this->_db->query($sql);
        
        $this->_picturesUploaded = $row['total'];

        $sql = 'SELECT count(*) as total FROM fcalendario_votos
            WHERE   member  =  '.$this->_id.'
            AND     anyo    = "'.$this->_options['actualContest'].'"
            AND     ronda   = "'.$this->_options['actualRound'].'"';
        $row = $this->_db->query($sql);
        
        $this->_votes = $row['total'];
    }
    
    public function picturesUploaded()
    {
        return $this->_picturesUploaded;
    }
    
}