<h1>Барааны жагсаалт</h1>


<a href="/products/create">
    Бараа нэмэх
</a>


<br><br>


<table border="1" cellpadding="8">

<tr>

    <th>№</th>

    <th>Бүлэг</th>

    <th>Нэр</th>

    <th>Үнэ</th>

    <th>Тоо ширхэг</th>

    <th>Нэмсэн цаг</th>

    <th>Үйлдэл</th>

</tr>



@foreach($products as $product)


<tr>


<td>
    {{ $product->id }}
</td>


<td>
    {{ $product->category->name ?? 'Бүлэггүй' }}
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
    {{ $product->created_at }}
</td>



<td>

<a href="/products/{{ $product->id }}/edit">

    Засах

</a>


<br><br>


<form action="/products/{{ $product->id }}" method="POST">

@csrf

@method('DELETE')


<button type="submit">

Устгах

</button>


</form>


</td>


</tr>


@endforeach


</table>