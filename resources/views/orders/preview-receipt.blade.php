<x-app-layout>

<style>

.receipt-wrapper{
    width:320px;
    margin:30px auto;
    background:white;
    padding:20px;
    font-family:monospace;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
}


.receipt-title{
    text-align:center;
    font-size:22px;
    font-weight:bold;
}


.receipt-center{
    text-align:center;
    margin-top:5px;
}


.line{
    border-top:1px dashed #555;
    margin:15px 0;
}


.item{
    display:flex;
    justify-content:space-between;
    margin-bottom:8px;
}


.total{
    display:flex;
    justify-content:space-between;
    font-size:20px;
    font-weight:bold;
}


.print-btn{

    width:100%;
    margin-top:20px;
    background:black;
    color:white;
    padding:12px;
    border-radius:8px;
    border:none;
    cursor:pointer;

}


.back-btn{

    display:block;
    text-align:center;
    margin-top:10px;

}



@media print {


    @page{

        size:80mm auto;

        margin:0;

    }


    body{

        margin:0;
        padding:0;

    }


    body *{

        visibility:hidden;

    }



    .receipt-wrapper,
    .receipt-wrapper *{

        visibility:visible;

    }



    .receipt-wrapper{

        position:absolute;

        left:0;
        top:0;

        width:80mm;

        padding:5mm;

        margin:0;

        box-shadow:none;

        font-size:12px;

    }



    .print-btn,
    .back-btn{

        display:none !important;

    }


}


</style>



<div class="receipt-wrapper">


<div class="receipt-title">

☕ Crescita 🍸

</div>



<div class="receipt-center">

БАРИМТ

</div>



<div class="line"></div>



<div>

Баримт №:

<b>

{{ $order->receipt_number ?? 'Түр баримт' }}

</b>

</div>



<div>

Ширээ:

<b>

{{ $order->table->name }}

</b>

</div>



<div>

Огноо:

{{ now()->format('Y-m-d H:i') }}

</div>



<div class="line"></div>




@foreach($order->items as $item)


<div class="item">


<div>

{{ $item->product->name }}

<br>

{{ $item->quantity }} x

{{ number_format($item->price) }}

</div>



<div>

{{ number_format(
$item->price * $item->quantity
) }}

₮

</div>


</div>


@endforeach




<div class="line"></div>



<div class="total">

<span>

Нийт

</span>


<span>

{{ number_format($order->total_price) }}

₮

</span>


</div>



<div class="line"></div>



<div class="receipt-center">

Төлөв:

@if($order->status == 'open')

Идэвхтэй захиалга

@else

Дууссан

@endif


</div>



<div class="line"></div>



<div class="receipt-center">

Баярлалаа 😊

</div>




<button
onclick="window.print()"
class="print-btn">

🖨 Баримт хэвлэх

</button>




<a href="{{ route('dashboard') }}"
class="back-btn">

← Dashboard

</a>



</div>


</x-app-layout>