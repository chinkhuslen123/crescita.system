<h1>
{{ $category->name }}
</h1>


<a href="/products/create?category_id={{ $category->id }}">

<button>
+ Бараа нэмэх
</button>

</a>


<br><br>


<table border="1" cellpadding="8">

<tr>

<th>
ID
</th>

<th>
Бараа
</th>

<th>
Үнэ
</th>

<th>
Тоо
</th>

<th>
Үйлдэл
</th>

</tr>



@foreach($products as $product)


<tr>


<td>
{{ $product->id }}
</td>


<td>
{{ $product->name }}
</td>


<td>
{{ number_format($product->price) }} ₮
</td>


<td>
{{ $product->quantity }}
</td>


<td>

<a href="/products/{{ $product->id }}/edit">

Засах

</a>


</td>


</tr>


@endforeach


</table>


<br>


<a href="/categories">

Буцах

</a>