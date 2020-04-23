<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        dd ($this);
        return [
            'success'   => $this->success ?? true,
            'message'   => $this->message ?? '',
            'code'      => $this->code ?? 200,
            'data'      => $this->data ?? null
        ];
    }
}
