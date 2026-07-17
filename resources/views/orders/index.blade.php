<x-app-layout>

<div class="min-h-screen bg-gradient-to-br from-slate-100 to-blue-100 p-6">


<div class="max-w-7xl mx-auto">


<div class="bg-white rounded-3xl shadow-xl p-6">



<h1 class="
text-3xl
font-black
text-gray-800
mb-6">

🧾 Идэвхтэй захиалгууд

</h1>





<div class="
overflow-x-auto
rounded-xl
shadow">


<table class="w-full bg-white text-sm">



<tr class="
bg-gray-800
text-white">


<th class="p-4">
Ширээ
</th>


<th class="p-4">
Эхэлсэн цаг
</th>


<th class="p-4">
Суусан хугацаа
</th>


<th class="p-4">
Бараа
</th>


<th class="p-4">
Нийт тооцоо
</th>


<th class="p-4">
Үйлдэл
</th>


</tr>






@forelse($orders as $order)



<tr class="
border-b
hover:bg-blue-50
transition
align-top">





<td class="
p-4
font-bold
text-lg">

🪑 {{ $order->table->name ?? $order->table_id }}


</td>






<td class="p-4">

{{ $order->start_time }}

</td>






<td class="p-4 text-blue-600 font-bold">

{{ \Carbon\Carbon::parse($order->start_time)->diffForHumans() }}

</td>








<td class="p-4">



<div class="
border
rounded-xl
overflow-hidden">


<table class="w-full">


<tr class="
bg-gray-100">


<th class="p-2 text-left">
Бараа
</th>


<th class="p-2">
Үнэ
</th>


<th class="p-2">
Тоо
</th>


<th class="p-2">
Нийт
</th>


</tr>






@forelse($order->items as $item)



<tr class="border-t">


<td class="p-2 font-bold">

{{ $item->product->name }}

</td>


<td class="p-2 text-center">

{{ number_format($item->price) }} ₮

</td>


<td class="p-2 text-center">

{{ $item->quantity }} ш

</td>


<td class="
p-2
text-center
font-bold
text-green-600">

{{ number_format($item->price * $item->quantity) }} ₮

</td>


</tr>






@empty


<tr>

<td colspan="4"
class="p-3 text-center text-gray-400">

Бараа нэмээгүй байна

</td>

</tr>


@endforelse





</table>


</div>



</td>







<td class="
p-4
text-center">


<span class="
bg-yellow-100
text-yellow-700
px-3
py-2
rounded-xl
font-black">


{{ number_format($order->total_price) }} ₮


</span>


</td>







<td class="p-4">



<div class="flex flex-col gap-2">





<a href="/orders/{{ $order->id }}/add-product">

<button

class="
w-full
bg-blue-600
hover:bg-blue-700
text-white
px-3
py-2
rounded-lg
font-bold">

➕ Бараа нэмэх

</button>

</a>







<a href="/orders/{{ $order->id }}">


<button

class="
w-full
bg-gray-700
hover:bg-gray-800
text-white
px-3
py-2
rounded-lg
font-bold">

👁 Харах

</button>


</a>








<a href="/orders/{{ $order->id }}/move">


<button

class="
w-full
bg-purple-600
hover:bg-purple-700
text-white
px-3
py-2
rounded-lg
font-bold">


🪑 Ширээ солих


</button>


</a>







<form action="/orders/{{ $order->id }}/close"

method="POST">


@csrf



<button

class="
w-full
bg-green-600
hover:bg-green-700
text-white
px-3
py-2
rounded-lg
font-bold">


✅ Дуусгах


</button>


</form>






</div>


</td>






</tr>





@empty



<tr>

<td colspan="6"
class="
p-8
text-center
text-gray-400
font-bold">


Одоогоор идэвхтэй захиалга алга


</td>


</tr>



@endforelse






</table>


</div>



</div>


</div>


</div>


</x-app-layout>