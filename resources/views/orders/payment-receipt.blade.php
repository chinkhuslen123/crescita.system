<form method="POST"
action="{{ route('orders.close',$order) }}">

@csrf


<input type="hidden"
name="payment_type"
value="cash">


<button
type="submit">

✔ Захиалга хаах

</button>

</form>