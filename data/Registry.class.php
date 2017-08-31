<?php
namespace data;
abstract class Registry{
    protected abstract function set($key, $val);
    protected abstract function get($key);
}