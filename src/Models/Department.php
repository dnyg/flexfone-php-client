<?php
namespace Flexfone\Models;

class Department
{
    public $Name;
    public $Street;
    public $Zipcode;
    public $City;
    public $Cvr;
    public $Contact;
    public $Email;
    public $Ean;
    public $Iref;

    public function __construct($department)
    {
        foreach ($department as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
