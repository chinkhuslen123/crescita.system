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
--border:#3A332C;

}


.move-page *{
box-sizing:border-box;
}


.move-page{

min-height:100vh;
background:var(--bg);
font-family:'Inter',sans-serif;
padding:40px 24px;

}



.move-container{

max-width:1100px;
margin:auto;

}




.move-header{

display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:40px;

}



.move-label{

color:var(--amber);
font-size:12px;
font-weight:700;
letter-spacing:.2em;
text-transform:uppercase;

}



.move-title{

font-family:'Fraunces',serif;
font-size:38px;
color:white;
margin-top:5px;

}



.move-sub{

color:#b5aa9a;
margin-top:10px;

}



.move-sub b{

color:#fff;

}



.move-back{

border:2px solid var(--border);
color:white;
padding:10px 22px;
border-radius:999px;
text-decoration:none;
font-weight:700;
transition:.2s;

}


.move-back:hover{

background:rgba(255,255,255,.1);

}




.move-card{

background:var(--card);
border-radius:20px;
padding:30px;
box-shadow:0 20px 40px rgba(0,0,0,.35);

}




.move-section-title{

font-family:'Fraunces',serif;
font-size:26px;
color:var(--ink);
margin-bottom:25px;

}




.table-grid{

display:grid;
grid-template-columns:
repeat(auto-fill,minmax(220px,1fr));
gap:20px;

}




.table-card{

background:white;
border:2px solid #E4DACB;
border-radius:18px;
padding:25px;
text-align:center;
transition:.25s;

}



.table-card:hover{

transform:translateY(-5px);
box-shadow:0 15px 30px rgba(0,0,0,.15);

}




.table-icon{

font-size:45px;

}



.table-name{

font-family:'Fraunces',serif;
font-size:28px;
font-weight:700;
color:var(--ink);
margin-top:10px;

}



.table-status{

display:inline-block;
background:#D9F0DF;
color:var(--green);
padding:6px 18px;
border-radius:999px;
font-weight:700;
font-size:13px;
margin-top:10px;

}




.move-btn{

width:100%;
margin-top:25px;

background:var(--amber);
border:none;
color:white;

padding:13px;

border-radius:12px;

font-weight:700;
font-size:15px;

cursor:pointer;

transition:.2s;

}



.move-btn:hover{

filter:brightness(1.1);

}




.empty-box{

text-align:center;
padding:40px;
color:var(--muted);
font-weight:700;

}


</style>




<div class="move-page">


<div class="move-container">



<div class="move-header">


<div>

<div class="move-label">
Ширээний үйлдэл
</div>


<h1 class="move-title">

🪑 Ширээ солих

</h1>



<p class="move-sub">

Одоогийн ширээ:
<b>
{{ $order->table->name }}
</b>

</p>


</div>




<a href="{{ route('orders.show',$order) }}"
class="move-back">

← Буцах

</a>



</div>





<div class="move-card">


<h2 class="move-section-title">

Сул ширээ сонгох

</h2>




<div class="table-grid">



@forelse($tables as $table)



<div class="table-card">


<div class="table-icon">
🪑
</div>



<div class="table-name">

{{ $table->name }}

</div>



<div class="table-status">

Сул

</div>




<form

action="{{ route('orders.update-move',$order) }}"

method="POST">


@csrf


<input type="hidden"
name="table_id"
value="{{ $table->id }}">



<button class="move-btn">

↔ Шилжүүлэх

</button>



</form>



</div>




@empty



<div class="empty-box">

😔 Сул ширээ алга байна

</div>


@endforelse



</div>


</div>



</div>


</div>


</x-app-layout>