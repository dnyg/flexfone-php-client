<?php
namespace Flexfone\Models;

class PhoneNumber extends BaseModel
{
    public $Number;
    public $LineName;
    public $BelongsTo;
    public $GotoLocalNumber;
}
