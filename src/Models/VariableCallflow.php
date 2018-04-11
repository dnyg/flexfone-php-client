<?php
namespace Flexfone\Models;

class VariableCallflow
{
    public $Localnumber;
    public $Name;
    public $IsActive;
    public $ActiveGoto;
    public $InactiveGoto;

    public function __construct($callflowData)
    {
        foreach ($callflowData as $key => $value) {
            $this->{$key} = $value;
        }
    }
}