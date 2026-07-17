<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Table;
use App\Models\DailyClosing;

class OrderController extends Controller
{

/**
     * Ширээ сонгоод захиалга эхлүүлэх
     */
    public function create(Table $table)
    {

        // Нээлттэй захиалга байгаа эсэх
        $order = Order::where('table_id', $table->id)
            ->where('status', 'open')
            ->first();


        // Байхгүй бол шинэ order үүсгэнэ
        if(!$order){

            DB::transaction(function () use ($table, &$order) {

                $order = Order::create([

                    'table_id' => $table->id,

                    'business_date' => DailyClosing::currentBusinessDate(),   // <-- ШИНЭЭР НЭМСЭН МӨР

                    'status' => 'open',

                    'start_time' => now(),

                    'total_price' => 0

                ]);


                $table->update([

                    'status' => 'busy'

                ]);


            });

        }


        return redirect()
            ->route('orders.show', $order);

    }







    /**
     * Хуучин order үүсгэх method
     * (ашиглахгүй байж болно)
     */
    public function store(Table $table)
    {

        if($table->status == 'busy'){

            return redirect('/tables')
                ->with(
                    'error',
                    'Энэ ширээ ашиглагдаж байна.'
                );

        }



        DB::transaction(function () use ($table){


            Order::create([

                'table_id'=>$table->id,

                'status'=>'open',

                'start_time'=>now(),

                'total_price'=>0

            ]);



            $table->update([

                'status'=>'busy'

            ]);


        });



        return redirect('/tables');

    }








    /**
     * Идэвхтэй захиалга харах
     */
    public function index()
    {

        $orders = Order::with([

            'table',

            'items.product'

        ])

        ->where('status','open')

        ->orderBy(
            'start_time',
            'desc'
        )

        ->get();



        return view(
            'orders.index',
            compact('orders')
        );

    }
    public function show(Order $order)
{

    $order->load([
        'table',
        'items.product'
    ]);


    return view(
        'orders.show',
        compact('order')
    );

}





public function cancel(Order $order)
{

    DB::transaction(function () use ($order){


        // Бараа нэмсэн бол устгахгүй

        if($order->items()->count() > 0){

            return;

        }



        $table = $order->table;



        // хоосон order устгах

        $order->delete();



        // ширээ сул болгох

        $table->update([

            'status'=>'empty'

        ]);



    });



    return redirect()
        ->route('dashboard')
        ->with(
            'success',
            'Хоосон захиалга цуцлагдлаа.'
        );

}



    /**
 * Захиалга хаах
 */
public function close(Request $request, Order $order)
{
    $request->validate([
        'payment_type' => 'required'
    ]);

    DB::transaction(function () use ($request, $order) {

        $order->update([
            'payment_type'   => $request->payment_type,
            'receipt_number' => 'R-'.date('YmdHis').'-'.$order->id,
            'end_time'       => now(),
            'status'         => 'closed',   // <-- нэмэгдсэн мөр
        ]);

        $order->table->update([
            'status' => 'empty',
        ]);

    });

    return redirect()
        ->route('orders.receipt', $order);
}
public function paymentReceipt(Order $order)
{
    $order->load([
        'table',
        'items.product'
    ]);

    return view(
        'orders.payment-receipt',
        compact('order')
    );
}
public function receipt(Order $order)
{

    $order->load([
        'table',
        'items.product'
    ]);


    return view(
        'orders.receipt',
        compact('order')
    );

}
public function previewReceipt(Order $order)
{
    $order->load([
        'table',
        'items.product'
    ]);


    return view(
        'orders.preview-receipt',
        compact('order')
    );
}


  public function move(Order $order)
{
    $tables = Table::where('status','empty')
        ->where('id','!=',$order->table_id)
        ->get();


    return view(
        'orders.move',
        compact('order','tables')
    );
}

public function updateMove(
    Request $request,
    Order $order
)
{

    $request->validate([
        'table_id'=>'required|exists:tables,id'
    ]);



    DB::transaction(function() use($request,$order){


        // шинэ ширээ авах

        $newTable = Table::findOrFail(
            $request->table_id
        );



        // шинэ ширээнд нээлттэй захиалга байгаа эсэх

        $existingOrder = Order::where(
            'table_id',
            $newTable->id
        )
        ->where('status','open')
        ->first();



        if($existingOrder){

            throw new \Exception(
                'Энэ ширээ дээр идэвхтэй захиалга байна.'
            );

        }




        // хуучин ширээг суллах

        $oldTable = $order->table;


        $oldTable->update([
            'status'=>'empty'
        ]);





        // шинэ ширээг авах

        $newTable->update([
            'status'=>'busy'
        ]);





        // захиалга шилжүүлэх

        $order->update([
            'table_id'=>$newTable->id
        ]);



    });



    return redirect()
        ->route('dashboard')
        ->with(
            'success',
            'Ширээ амжилттай солигдлоо.'
        );

}






    /**
     * Бараа сонгох
     */
    public function addProduct(Order $order)
{

    $categories = \App\Models\Category::with('products')
        ->orderBy('name')
        ->get();


    return view(
        'orders.add-product',
        compact(
            'order',
            'categories'
        )
    );

}










    /**
     * Бараа нэмэх
     */
    public function storeProduct(
        Request $request,
        Order $order
    )
    {


        $request->validate([

            'product_id'=>'required|exists:products,id',

            'quantity'=>'required|integer|min:1'

        ]);





        DB::transaction(function () use(
            $request,
            $order
        ){


            $product = Product::findOrFail(
                $request->product_id
            );




            // Ижил бараа байгаа эсэх

            $item = OrderItem::where(
                'order_id',
                $order->id
            )

            ->where(
                'product_id',
                $product->id
            )

            ->first();






            if($item){


                $item->update([

                    'quantity'=>
                    $item->quantity
                    +
                    $request->quantity

                ]);


            }

            else{


                OrderItem::create([

                    'order_id'=>$order->id,

                    'product_id'=>$product->id,

                    'quantity'=>$request->quantity,

                    'price'=>$product->price,

                    'added_time'=>now()

                ]);


            }






            // Нийт үнэ шинэчлэх

            $total = OrderItem::where(
                'order_id',
                $order->id
            )

            ->get()

            ->sum(function($item){

                return 
                $item->price *
                $item->quantity;

            });




            $order->update([

                'total_price'=>$total

            ]);



        });





        return redirect()
    ->route('orders.show', $order)
    ->with(
        'success',
        'Бараа нэмэгдлээ.'
    );


    }




public function save(Order $order)
{

    return redirect()
        ->route('dashboard')
        ->with(
            'success',
            'Захиалга хадгалагдлаа.'
        );

}

public function removeItem(OrderItem $item)
{

    $order = $item->order;


    DB::transaction(function () use ($item, $order) {


        // барааг устгах

        $item->delete();



        // нийт дүн шинэчлэх

        $order->updateTotal();


    });



    return redirect()
        ->back()
        ->with(
            'success',
            'Бараа хасагдлаа.'
        );

}





    /**
     * Өдрийн борлуулалтын тайлан
     */
    public function dailyReport()
{
    $orders = Order::where(
        'status',
        'closed'
    )
    ->with(
        'items.product'
    )
    ->orderBy(
        'end_time',
        'desc'
    )
    ->get();


    $totalSales = $orders->sum(
        'total_price'
    );


    $totalOrders = $orders->count();


    return view(
        'reports.daily',
        compact(
            'orders',
            'totalSales',
            'totalOrders'
        )
    );
}
    public function finish(Order $order)
{

    DB::transaction(function () use ($order){


        $order->update([

            'status'=>'closed',

            'end_time'=>now()

        ]);


        $order->table->update([

            'status'=>'empty'

        ]);


    });


    return redirect()
        ->route('dashboard')
        ->with(
            'success',
            'Захиалга дууслаа.'
        );

}


}
