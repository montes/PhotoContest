<?php

namespace PhotoContest;

interface Db
{
    public function query($sql);
    public function insert($tableName, $dataTypes, $data);
    public function update($tableName, $dataTypes, $data, $keys);
    public function insert_id();
}