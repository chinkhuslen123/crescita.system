<h1>Менюны бүлэг</h1>

<a href="/categories/create">
    <button>
        + Шинэ бүлэг нэмэх
    </button>
</a>

<br><br>


<table border="1" cellpadding="8">

<tr>
    <th>ID</th>
    <th>Нэр</th>
    <th>Үйлдэл</th>
</tr>


@foreach($categories as $category)

<tr>

<td>
    {{ $category->id }}
</td>


<td>

<a href="/categories/{{ $category->id }}">

    {{ $category->name }}

</a>

</td>


<td>

<a href="/categories/{{ $category->id }}/edit">
    Засах
</a>


<form action="/categories/{{ $category->id }}"
      method="POST"
      style="display:inline">

@csrf
@method('DELETE')


<button type="submit"
onclick="return confirm('Устгах уу?')">

Устгах

</button>


</form>


</td>

</tr>

@endforeach


</table>