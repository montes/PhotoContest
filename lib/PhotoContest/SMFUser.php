<?php

namespace PhotoContest;

class SMFUser extends User
{
    
    public function __construct($context, $user_info, $db, $options)
    {
        $this->_id      = $context['user']['id'];
        $this->_name    = $context['user']['name'];
        $this->_isGuest = $context['user']['is_guest'];
        $this->_db      = $db;
        
        if ($context['user']['is_admin']
            || in_array("1", $user_info['groups'])
            || in_array("9", $user_info['groups'])
            || in_array("2", $user_info['groups'])
            || $this->_id == '3140'
            ) {
            
            $this->_isAdmin = true;
        }
        
        parent::__construct($options);
    }
    
    public function isAdmin()
    {
        return $this->_isAdmin;
    }
    
}