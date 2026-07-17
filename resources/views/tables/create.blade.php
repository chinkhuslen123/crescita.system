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



.table-page *{
box-sizing:border-box;
}



.table-page{

min-height:100vh;
background:var(--bg);
font-family:'Inter',sans-serif;
padding:40px 24px;

}



.table-container{

max-width:1100px;
margin:auto;

}



.table-header{

display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:40px;

}



.table-label{

font-size:12px;
letter-spacing:.2em;
color:var(--amber);
font-weight:700;
text-transform:uppercase;

}



.table-title{

font-family:'Fraunces',serif;
font-size:38px;
color:white;
margin-top:5px;

}



.dashboard-btn{

border:2px solid var(--border);
color:white;
padding:10px 22px;
border-radius:999px;
text-decoration:none;
font-weight:700;
transition:.2s;

}



.dashboard-btn:hover{

background:rgba(255,255,255,.1);

}




.table-card{

background:var(--card);
border-radius:20px;
padding:30px;
box-shadow:0 20px 40px rgba(0,0,0,.35);

}



.form-title{

font-family:'Fraunces',serif;
font-size:25px;
color:var(--ink);
margin-bottom:20px;

}




.table-form{

display:flex;
gap:15px;

}



.table-input{

flex:1;
padding:14px 18px;
border-radius:12px;
border:2px solid #E4DACB;
font-size:16px;

}



.table-input:focus{

outline:none;
border-color:var(--amber);

}



.save-btn{

background:var(--green);
color:white;
border:none;
padding:14px 25px;
border-radius:12px;
font-weight:700;
cursor:pointer;

}



.save-btn:hover{

filter:brightness(1.1);

}





.table-list{

margin-top:35px;

display:grid;

grid-template-columns:
repeat(auto-fill,minmax(220px,1fr));

gap:20px;

}



.table-item{

background:white;
border-radius:18px;
padding:25px;
text-align:center;
border:2px solid #E4DACB;

}



.table-icon{

font-size:45px;

}



.table-name{

font-family:'Fraunces',serif;
font-size:28px;
font-weight:700;
color:var(--ink);

}



.status-empty{

display:inline-block;
background:#D9F0DF;
color:var(--green);
padding:6px 15px;
border-radius:999px;
font-weight:700;
margin-top:10px;

}



.status-busy{

display:inline-block;
background:#FADBD7;
color:var(--red);
padding:6px 15px;
border-radius:999px;
font-weight:700;
margin-top:10px;

}



.delete-btn{

margin-top:20px;
width:100%;

background:var(--red);
color:white;

border:none;

padding:12px;

border-radius:12px;

font-weight:700;

cursor:pointer;

}


.delete-btn:hover{

filter:brightness(1.1);

}


</style>





<div class="table-page">


<div class="table-container">



<div class="table-header">


<div>

<div class="table-label">
Restaurant Manager
</div>


<h1 class="table-title">

🪑 Ширээ удирдах

</h1>


</div>



<a href="{{ route('dashboard') }}"
class="dashboard-btn">

← Dashboard

</a>



</div>





<div class="table-card">



<h2 class="form-title">

➕ Шинэ ширээ нэмэх

</h2>



<form action="{{ route('tables.store') }}"
method="POST"
class="table-form">


@csrf


<input

class="table-input"

type="text"

name="name"

placeholder="Жишээ: 1-р ширээ"

required>



<button class="save-btn">

Хадгалах

</button>


</form>




<div class="table-list">



@foreach($tables as $table)



<div class="table-item">



<div class="table-icon">
🪑
</div>



<div class="table-name">

{{ $table->name }}

</div>




@if($table->status == 'busy')


<div class="status-busy">

🔴 Завгүй

</div>


@else


<div class="status-empty">

🟢 Сул

</div>


@endif





<form

action="{{ route('tables.destroy',$table) }}"

method="POST">


@csrf

@method('DELETE')



<button

onclick="return confirm('Энэ ширээг устгах уу?')"

class="delete-btn">


🗑 Устгах


</button>



</form>




</div>



@endforeach



</div>



</div>



</div>


</div>


</x-app-layout>