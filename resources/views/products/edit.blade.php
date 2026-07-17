<h1>Бараа засах</h1>


<form action="/products/{{ $product->id }}"
method="POST">


@csrf

@method('PUT')



<label>
Бүлэг:
</label>

<br>


<select name="category_id">


@foreach($categories as $category)


<option value="{{ $category->id }}"
@if($product->category_id == $category->id)
selected
@endif
>

{{ $category->name }}

</option>


@endforeach


</select>


<br><br>



<label>
Нэр:
</label>

<br>

<input type="text"
name="name"
value="{{ $product->name }}">


<br><br>



<label>
Үнэ:
</label>

<br>

<input type="number"
name="price"
value="{{ $product->price }}">


<br><br>



<label>
Тоо:
</label>

<br>

<input type="number"
name="quantity"
value="{{ $product->quantity }}">


<br><br>



<button type="submit">

Хадгалах

</button>


</form>


<br>


<a href="/products">
Буцах
</a>