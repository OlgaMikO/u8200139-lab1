<?php

namespace App;

class Department
{
    private $employees = array();

    private string $name;

    public function __construct($employees, string $name){
        $this -> employees = array_merge($this -> employees, $employees);
        $this -> name = $name;
    }

    public function get_summary_salary() : float
    {
        $sum_salary = 0.0;
        foreach ($this->employees as $employee)
        {
            $sum_salary += $employee -> get_salary();
        }

        return $sum_salary;
    }

    public function get_employees() : array
    {
        return $this->employees;
    }

    public function get_name() : string
    {
        return $this -> name;
    }
}
