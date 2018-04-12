<?php
namespace Flexfone\Models;

class Phone extends BaseModel
{
    /**
     * @var int
     */
    public $LocalNumber;

    /**
     * @var string
     */
    public $Name;
    public $Type;

    /**
     * @var string
     */
    public $MAC;

    /**
     * @var int
     */
    public $BelongsTo;
}
