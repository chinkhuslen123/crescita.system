<h1>
Бүлэг засах
</h1>


<form action="/categories/{{ $category->id }}"
      method="POST">


@csrf

@method('PUT')


<label>
Бүлгийн нэр
</label>

<br>


<input type="text"
       name="name"
       value="{{ $category->name }}">


<br><br>


<button type="submit">

Хадгалах

</button>


</form>


<br>


<a href="/categories">
Буцах
</a>