<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Services\ResponseServiceInterface;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Boolean;

class OrderController extends BaseController
{
    protected $responseService;

    public function __construct(ResponseServiceInterface $responseService, Request $request)
    {
        $this->responseService = $responseService;
    }

    /**
     * Create an order
     */
    public function create(Request $request) {
        # Validate input data
        $params = $request->all();
        $this->validateData($request);
        $this->validate($request, [
            'date' => 'required|integer|max:365|min:1',
            'fruits' => 'required',
        ]);

        # Validate data of detail order
        try {
            $fruits = $params['fruits'];
            if (empty($fruits)) {
                return $this->responseService->response('Data is invalid', 400);
            }
            $tmpRequest = $request;
            foreach($fruits as $productID => $amount) {
                $tmpRequest["id"] = $productID;
                $tmpRequest["amount"] = $amount;

                $this->validate($tmpRequest, [
                    'id' => 'required|integer|exists:products', # validate product_id
                    'amount' => 'required|numeric|min:0|not_in:0|max:100',
                ]);
            }
        } catch (\Throwable $th) {
            return $this->responseService->response("Params is invalid", 400);
        }

        # Create order
        try {
            DB::beginTransaction();
            $params = $request->all();
            $order = Order::create($params);

            # Create order details
            $fruitParams = [];
            $fruits = $params['fruits'];
            foreach ($fruits as $productID => $amount) {
                $fruitParams[] = ['order_id'=> $order->id,
                            'product_id'=> $productID,
                            'amount'=> $amount];
            }
            $order->orderDetail()->insert($fruitParams);
            DB::commit();

            return $this->responseService->response('success');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseService->response("Params is invalid", 400);
        }
    }


    /**
     * Validate request data
     */
    public function validateData($request) {
    }
}
