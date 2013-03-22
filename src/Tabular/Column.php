<?php

namespace Tabular;

class Column
{
    protected $id = null;
    protected $name = null;
    protected $key = null;
    protected $attributes = array();

    public function __construct($name = null, $key = null, $attributes = array())
    {
        $this->set_name($name);
        $this->set_key($key);
        $this->set_attributes($attributes);
    }

    public function set_attributes($attr = array())
    {
        $this->attributes = array_merge($this->attributes, $attr);
        return $this;
    }

    public function set_name($name = null)
    {
        $this->name = $name;
        return $this;
    }

    public function set_id($id = null)
    {
        $this->id = $id;
        return $this;
    }

    public function set_key($key = null)
    {
        $this->key = (string) $key;
        return $this;
    }

    public function name()
    {
        return $this->name;
    }

    public function id()
    {
        return !empty($this->id) ? $this->id : $this->name();
    }

    public function key()
    {
        return $this->key;
    }

    public function attributes()
    {
        return $this->attributes;
    }
}