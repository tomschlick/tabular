<?php

namespace Tabular;

class Row
{
    protected $id = null;
    protected $attributes = array();
    protected $data = array();

    public function __construct($data = array(), $attributes = array())
    {
        $this->set_data($data);
        $this->add_attributes($attributes);
    }

    public function set_data($data = array())
    {
        $this->data = $data;
        return $this;
    }

    public function add_attributes($attr = array())
    {
        $this->attributes = array_merge($this->attributes, $attr);
        return $this;
    }

    public function set_id($id = null)
    {
        $this->id = $id;
        return $this;
    }

    public function get_data($key = null, $default = null)
    {
        return \FuelPHP\Common\Arr::get($this->data, $key, $default);
    }
}