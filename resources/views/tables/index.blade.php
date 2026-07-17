<a href="{{ route('dashboard') }}"
   class="bg-gray-500 text-white px-4 py-2 rounded inline-block mb-4">
    ← Dashboard
</a>
<h1>Ширээний жагсаалт</h1>


<a href="{{ route('tables.create') }}">

<button type="button">
    + Шинэ ширээ нэмэх
</button>

</a>


<br><br>


<table border="1">

<tr>
    <th>ID</th>
    <th>Ширээ</th>
    <th>Төлөв</th>
    <th>Үйлдэл</th>
</tr>


@foreach($tables as $table)

<tr>

<td>
    {{ $table->id }}
</td>


<td>
    {{ $table->name }}
</td>


<td>
    {{ $table->status }}
</td>


<td>

@if($table->status == 'empty')


<a href="/tables/{{ $table->id }}/order">

<button type="button">
    Захиалга эхлүүлэх
</button>

</a>


@else


<a href="/tables/{{ $table->id }}/order">

<button type="button">
    Захиалга харах
</button>

</a>


@endif


</td>


</tr>


@endforeach


</table>