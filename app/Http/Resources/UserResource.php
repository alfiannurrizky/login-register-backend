<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public $status;
    public $message;

    public $token;

    public function __construct($status, $message, $token)
    {
        $this->status  = $status;
        $this->message = $message;
        $this->token = $token;
    }

    public function toArray($request)
    {
        return [
            'success'   => $this->status,
            'message'   => $this->message,
            'token'      => $this->token
        ];
    }
}
