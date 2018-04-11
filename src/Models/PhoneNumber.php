<?php
namespace Flexfone\Models;

class PhoneNumber
{
    public $Number;
    public $LineName;
    public $BelongsTo;
    public $GotoLocalNumber;

    public function __construct($phoneNumber)
    {
        foreach ($phoneNumber as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
