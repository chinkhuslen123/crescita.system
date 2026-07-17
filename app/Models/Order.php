<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'table_id',
        'start_time',
        'end_time',
        'status',
        'total_price',
        'payment_type'
    ];


    /**
     * Захиалга аль ширээнд хамаарах
     */
    public function table()
    {
        return $this->belongsTo(Table::class);
    }


    /**
     * Захиалгын бараанууд
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }


    /**
     * Захиалгын нийт үнийг автоматаар бодох
     */
    public function calculateTotal()
    {
        return $this->items->sum(function($item){

            return $item->price * $item->quantity;

        });
    }


    /**
     * Нийт дүнг шинэчлэх
     */
    public function updateTotal()
    {

        $this->update([

            'total_price' => $this->calculateTotal()

        ]);

    }

}