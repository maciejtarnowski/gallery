<?php

namespace Database;

interface Driver
{
    public function query($sql, $parameters);
    public function queryAll($sql, $parameters);
}
