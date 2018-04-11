<?php
namespace Flexfone\Models;

class Phone
{
    public $LocalNumber;
    public $Name;
    public $Type;
    public $MAC;
    public $BelongsTo;

    public function __construct($phone)
    {
        foreach ($phone as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
