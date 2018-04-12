<?php
namespace Flexfone\Models;

class VariableCallflow extends BaseModel
{
    /**
     * @var int
     */
    public $Localnumber;

    /**
     * @var string
     */
    public $Name;

    /**
     * @var bool
     */
    public $IsActive;

    /**
     * @var int
     */
    public $ActiveGoto;

    /**
     * @var int
     */
    public $InactiveGoto;
}
