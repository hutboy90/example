<?php

namespace App\Services;

use App\Services\ResponseServiceInterface;
use App\Models\Response;
use App\Http\Resources\Api\ResponseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponseService implements ResponseServiceInterface
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function response($data = null, $code = 200, $message = "")
    {
        $this->response->fill([
            'success'   => $code == 200,
            'code'      => $code,
            'message'   => $message,
            'data'      => $data
        ]);

        return response()->json( $this->response, $this->response->code);
    }
}
