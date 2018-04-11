<?php
namespace Flexfone\Models;

class ActionResponse
{
    public $Message;
    public $Success;

    public function __construct($response)
    {
        $this->Message = $response->Message;
        $this->Success = $response->Success;
    }
}
