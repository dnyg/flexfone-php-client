<?php
namespace Flexfone\Models;

class BaseModel
{
    public function __construct(array $values)
    {
        foreach ($values as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
