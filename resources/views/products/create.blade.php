<x-app-layout>

<div class="p-6">


<div style="
width:420px;
margin:auto;
background:white;
padding:25px;
border-radius:15px;
box-shadow:0 4px 15px #ccc;
">


<h1 style="
font-size:24px;
font-weight:bold;
margin-bottom:20px;
color:#1f2937;
">

📦 Шинэ бараа нэмэх

</h1>





<form action="/products" method="POST">

@csrf





<label style="
font-weight:bold;
display:block;
margin-bottom:8px;
">

📂 Бүлэг

</label>



<div style="
display:flex;
gap:10px;
margin-bottom:20px;
">


<select 
name="category_id"
required

style="
flex:1;
padding:10px;
border:1px solid #ddd;
border-radius:10px;
"
>


<option value="">
-- Бүлэг сонгох --
</option>



@foreach($categories as $category)

<option value="{{ $category->id }}"

@if(isset($selectedCategory) && $selectedCategory == $category->id)

selected

@endif

>

{{ $category->name }}

</option>

@endforeach


</select>





<a href="{{ route('categories.create') }}"

style="
background:#16a34a;
color:white;
padding:10px 14px;
border-radius:10px;
text-decoration:none;
font-weight:bold;
">

+

</a>



</div>







<label style="
font-weight:bold;
display:block;
margin-bottom:8px;
">

🏷 Барааны нэр

</label>


<input
type="text"
name="name"
required

style="
width:100%;
padding:10px;
border:1px solid #ddd;
border-radius:10px;
margin-bottom:20px;
"
>







<label style="
font-weight:bold;
display:block;
margin-bottom:8px;
">

💰 Үнэ

</label>


<input
type="number"
name="price"
min="0"
required

style="
width:100%;
padding:10px;
border:1px solid #ddd;
border-radius:10px;
margin-bottom:20px;
"
>







<label style="
font-weight:bold;
display:block;
margin-bottom:8px;
">

📦 Тоо ширхэг

</label>


<input
type="number"
name="quantity"
value="1"
min="0"
required

style="
width:100%;
padding:10px;
border:1px solid #ddd;
border-radius:10px;
margin-bottom:25px;
"
>







<button
type="submit"

style="
width:100%;
background:#2563eb;
color:white;
padding:12px;
border:none;
border-radius:10px;
font-weight:bold;
font-size:16px;
box-shadow:0 4px 10px #999;
cursor:pointer;
">

💾 Хадгалах

</button>




</form>





<a href="{{ route('dashboard') }}"

style="
display:block;
margin-top:15px;
text-align:center;
color:#6b7280;
text-decoration:none;
">

← Буцах

</a>




</div>


</div>


</x-app-layout>