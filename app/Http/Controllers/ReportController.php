<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Services\ResponseServiceInterface;


class ReportController extends BaseController
{
    protected $responseService;

    public function __construct(ResponseServiceInterface $responseService, Request $request)
    {
        $this->responseService = $responseService;
    }

    /**
     * Create an order
     */
    public function list(Request $request) {
        # Validate request params
        $this->validate($request, [
            'from'  => 'integer|max:365|min:1',
            'to'    => 'integer|max:365|min:1',
        ]);

        $params = $request->all();
        $datas = Order::report($params);

        # Processing the result
        $result = [];
        foreach($datas as $data) {
            $result[$data->name] = number_format((float)$data->amount, 2, '.', '');
        }
        return $this->responseService->response($result);
    }
}
