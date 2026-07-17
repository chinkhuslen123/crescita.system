<x-app-layout>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


<style>

:root{

--bg:#1C1917;
--card:#FDF8F0;
--ink:#2B2320;
--muted:#8A8074;
--amber:#D08A3E;
--green:#3F7D58;
--red:#B5473A;
--yellow:#B7791F;
--border:#E4DACB;

}



.show-page *{
box-sizing:border-box;
}



.show-page{

min-height:100vh;
background:var(--bg);
font-family:'Inter',sans-serif;
padding:40px 24px;

}




.show-container{

max-width:1000px;
margin:auto;

}




.show-header{

display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:40px;

}




.show-label{

font-size:12px;
font-weight:700;
letter-spacing:.2em;
color:var(--amber);
text-transform:uppercase;

}




.show-title{

font-family:'Fraunces',serif;
font-size:40px;
color:white;
margin-top:5px;

}





.show-card{

background:var(--card);
border-radius:22px;
padding:30px;
box-shadow:0 20px 40px rgba(0,0,0,.35);

}




.order-table{

width:100%;
border-collapse:collapse;
overflow:hidden;

}



.order-table th{

background:#2B2320;
color:white;
padding:15px;
text-align:left;
font-weight:700;

}



.order-table td{

padding:15px;
border-bottom:2px dashed var(--border);
color:var(--ink);
font-weight:500;

}



.order-table tr:last-child td{

border-bottom:none;

}



.price{

font-family:monospace;
font-weight:700;
color:#C05A3E;

}





.total-box{

margin-top:30px;

background:#2B2320;

padding:25px;

border-radius:18px;

display:flex;

justify-content:space-between;

align-items:center;

}




.total-title{

color:#B5AA9A;
font-weight:700;
letter-spacing:.15em;
font-size:13px;

}



.total-price{

font-family:'Fraunces',serif;
font-size:35px;
font-weight:700;
color:white;

}




.action-area{

display:flex;
flex-wrap:wrap;
gap:15px;
margin-top:30px;

}



.action-btn{

padding:13px 22px;
border-radius:12px;
font-weight:700;
text-decoration:none;
border:none;
cursor:pointer;
transition:.2s;

}



.add-btn{

background:var(--green);
color:white;

}



.add-btn:hover{

filter:brightness(1.1);

}




.move-btn{

background:var(--amber);
color:white;

}



.move-btn:hover{

filter:brightness(1.1);

}




.close-btn{

background:var(--red);
color:white;

}



.close-btn:hover{

filter:brightness(1.1);

}




.cancel-btn{

background:#44403C;
color:white;

}



.cancel-btn:hover{

background:#292524;

}





.empty{

text-align:center;
padding:40px;
color:var(--muted);
font-weight:700;

}


</style>





<div class="show-page">


<div class="show-container">





<div class="show-header">


<div>


<div class="show-label">

Захиалга

</div>


<h1 class="show-title">

🪑 {{ $order->table->name }}

</h1>


</div>



</div>






<div class="show-card">





<table class="order-table">


<tr>

<th>
Бараа
</th>

<th>
Тоо
</th>

<th>
Үнэ
</th>

<th>
Нийт
</th>

<th>
Үйлдэл
</th>

</tr>




@forelse($order->items as $item)



<tr>


<td>

{{ $item->product->name }}

</td>


<td>

{{ $item->quantity }}

</td>


<td class="price">

{{ number_format($item->price) }} ₮

</td>


<td class="price">

{{ number_format($item->price * $item->quantity) }} ₮

</td>



<td>

<form method="POST"
action="{{ route('order-items.remove',$item) }}">

@csrf

@method('DELETE')


<button

onclick="return confirm('Энэ барааг хасах уу?')"

class="bg-red-500 text-white px-3 py-1 rounded-lg">

❌

</button>


</form>

</td>


</tr>



@empty


<tr>

<td colspan="5">

<div class="empty">

🛒 Бараа нэмээгүй байна

</div>

</td>

</tr>



@endforelse



</table>







<div class="total-box">


<div class="total-title">

НИЙТ ТООЦОО

</div>


<div class="total-price">

{{ number_format($order->total_price) }} ₮

</div>



</div>






<div class="action-area">



<a href="{{ route('orders.add-product',$order) }}"
class="action-btn add-btn">

➕ Бараа нэмэх

</a>





<a href="{{ route('orders.move',$order) }}"
class="action-btn move-btn">

↔ Ширээ солих
</a>

<a href="{{ route('orders.preview-receipt',$order) }}"
class="action-btn">

🧾 Баримт харах

</a>






<form method="POST"
      action="{{ route('orders.close', $order) }}"
      onsubmit="return confirm('Төлбөр дуусгаж захиалгыг хаах уу?');">

    @csrf

    <select
        name="payment_type"
        required
        class="border rounded-xl px-4 py-2">

        <option value="">
            Төлбөр сонгох
        </option>

        <option value="cash">
            💵 Бэлэн
        </option>

        <option value="card">
            💳 Карт
        </option>

        <option value="qpay">
            📱 QPay
        </option>

    </select>


    <button
        type="submit"
        class="bg-green-600 text-black px-5 py-2 rounded-xl">

        ✔ Төлбөр дуусгах

    </button>

</form>






<form action="{{ route('orders.cancel', $order) }}" method="POST" style="display:inline;">
    @csrf

    <button type="submit" class="action-btn cancel-btn">
        ← Буцах
    </button>

</form>





</div>





</div>



</div>


</div>


</x-app-layout>
