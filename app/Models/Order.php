<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'date'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required', 'integer',
            'date' => 'required','integer',
        ];
    }

    public function orderDetail() {
        return $this->hasMany(OrderDetail::class);
    }


    /**
     * Create report from date to date
     */
    public static function report($params) {
        $from = $params['from'] ?? 1;
        $to = $params['to'] ?? 365;
        $query = "  SELECT P.name, SUM(amount) as amount FROM orders as O
                    INNER JOIN `order_details` as OD ON O.id = OD.order_id AND (`date` BETWEEN $from AND $to)
                    INNER JOIN `products` as P ON P.id = OD.product_id
                    GROUP BY product_id
                    ";

        return DB::select($query);
    }
}
