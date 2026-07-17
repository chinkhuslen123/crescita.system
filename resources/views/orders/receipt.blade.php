<x-app-layout>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

.receipt-page{

    min-height:100vh;

    background:#1C1917;

    display:flex;

    align-items:center;

    justify-content:center;

    padding:40px 20px;

}

.receipt-wrapper{

    width:340px;

    margin:0 auto;

    background:white;

    padding:28px 24px;

    border-radius:6px;

    box-shadow:0 20px 40px rgba(0,0,0,.35);

    font-family:'JetBrains Mono', monospace;

    font-size:12px;

    color:#2B2320;

}



.receipt-title{

    text-align:center;

    font-family:'Fraunces', serif;

    font-size:22px;

    font-weight:700;

    color:#2B2320;

}



.receipt-center{

    text-align:center;

    margin-top:4px;

    font-size:11px;

    letter-spacing:.15em;

    text-transform:uppercase;

    color:#8A8074;

    font-weight:600;

}



.line{

    border-top:2px dashed #D9CFC1;

    margin:14px 0;

}



.info{

    line-height:1.8;

}

.info b{

    font-weight:700;

}



.item{

    display:flex;

    justify-content:space-between;

    gap:5px;

    margin-bottom:10px;

}



.item-name{

    width:60%;

    font-weight:600;

}

.item-meta{

    display:block;

    color:#8A8074;

    font-weight:400;

    margin-top:2px;

}



.item-price{

    width:40%;

    text-align:right;

    font-weight:600;

}



.total{

    display:flex;

    justify-content:space-between;

    font-family:'Fraunces', serif;

    font-size:20px;

    font-weight:700;

    color:#C05A3E;

}



.payment{

    margin-top:10px;

    text-align:center;

    font-weight:600;

}



.print-btn{

    width:100%;

    margin-top:20px;

    background:#1C1917;

    color:white;

    padding:14px;

    border-radius:10px;

    border:none;

    font-size:15px;

    font-weight:700;

    font-family:'Inter', sans-serif;

    cursor:pointer;

    transition:.2s;

}

.print-btn:hover{

    background:#000;

}



.back-btn{

    display:block;

    text-align:center;

    margin-top:12px;

    color:#8A8074;

    font-size:13px;

    font-weight:600;

    font-family:'Inter', sans-serif;

    text-decoration:none;

    transition:.2s;

}

.back-btn:hover{

    color:#D08A3E;

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

        border-radius:0;

        font-size:12px;

        color:#000 !important;

        background:#fff !important;

    }

    .receipt-wrapper .total,

    .receipt-wrapper .receipt-title{

        color:#000 !important;

    }



    .print-btn,

    .back-btn{

        display:none !important;

    }


}


</style>


<div class="receipt-page">


<div class="receipt-wrapper">


<div class="receipt-title">

☕ Crescita 🍸

</div>



<div class="receipt-center">

БАРИМТ

</div>



<div class="line"></div>




<div class="info">


<div>

Баримт №:

<b>
{{ $order->receipt_number }}
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

{{ $order->end_time }}

</div>


</div>




<div class="line"></div>





@foreach($order->items as $item)


<div class="item">


<div class="item-name">

{{ $item->product->name }}

<span class="item-meta">

{{ $item->quantity }} x
{{ number_format($item->price) }}

</span>

</div>



<div class="item-price">


{{ number_format(
$item->price * $item->quantity
) }}

₮


</div>



</div>


@endforeach





<div class="line"></div>




<div class="total">


<div>

НИЙТ

</div>



<div>

{{ number_format($order->total_price) }}

₮

</div>


</div>





<div class="line"></div>





<div class="payment">


Төлбөр:


@if($order->payment_type == 'cash')

💵 Бэлэн мөнгө


@elseif($order->payment_type == 'card')

💳 Карт


@elseif($order->payment_type == 'qpay')

📱 QPay


@endif


</div>





<div class="line"></div>




<div class="receipt-center">

Баярлалаа 😊

<br>

Дахин үйлчлүүлээрэй

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


</div>


</x-app-layout>