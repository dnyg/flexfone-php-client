<?php
namespace Flexfone\Models;

class EmployeeInfo
{
    public const TYPE_DROPDOWN = 1;
    public const TYPE_EMPLOYEE = 2;
    public const TYPE_TEXTFIELD = 3;

    public $Label;
    public $Value;

    public function __construct($info)
    {
        foreach ($info as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
