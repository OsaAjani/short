<?php

namespace models;

class Short extends \Model
{
    public function get_one_by_url ($url)
    {
        return $this->get_one('short', ['url' => $url]);
    }
    
    public function get_one_by_uid ($uid)
    {
        return $this->get_one('short', ['uid' => $uid]);
    }

    public function create ($url, $uid)
    {
        return $this->insert('short', ['url' => $url, 'uid' => $uid]);
    }
}
