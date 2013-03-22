<?php

namespace Tabular;

class Table
{
    protected $id = null;
    protected $attributes = array();
    protected $columns = array();
    protected $rows = array();

    public function __construct($data = array(), $attributes = array())
    {
        if(!empty($data))
        {
            foreach($data as $row)
            {
                $this->add_row($row);
            }
        }

        $this->set_attributes($attributes);
    }

    public static function forge($data = array())
    {
        return new self($data);
    }

    public function add_column($name = null, $array_key = null, $attributes = array())
    {
        $this->columns[] = new Column($name, $array_key, $attributes);
        return $this;
    }

    public function add_row($data = array(), $attributes = array())
    {
        $this->rows[] = new Row($data, $attributes);
        return $this;
    }

    public function build()
    {
        $table = new \FuelPHP\Common\Table;

        // Table Header
        $table->createRow(\FuelPHP\Common\Table\EnumRowType::Header);
        foreach($this->columns as $header)
        {
            $table->addCell($header->name());
        }
        $table->addRow();

        // Table Body
        foreach($this->rows as $row)
        {
            $table->createRow();
            foreach($this->columns as $column)
            {
                $data = $row->get_data($column->key());
                $table->addCell($data);
            }
            $table->addRow();
        }

        // Table Render
        $render = new \FuelPHP\Common\Table\Render\SimpleTable;
        return $render->renderTable($table);
    }

    public function set_attributes($attr = array())
    {
        $this->attributes = array_merge($this->attributes, $attr);
        return $this;
    }

    public function __toString()
    {
        return $this->build();
    }
}