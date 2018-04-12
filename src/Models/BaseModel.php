<?php
namespace Flexfone\Models;

use stdClass;

class BaseModel
{
    public function __construct(stdClass $values)
    {
        foreach ($values as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
