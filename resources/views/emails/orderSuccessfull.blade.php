@component('mail::message')

Congratulations ***{{$user->name}}*** your order has been placed successfully!
Our team is working hard while ensuring highest safety standards in these tough times. ***Deliveries may take longer than usual***, we are trying our best to deliver it soon.

### Order Summary:<br>

ORDER ID: ***{{ $order_id }}***
@foreach ($products as $product)

{{$loop->iteration}}. **{{$product[0]->name}}**

    **Price:** {{$amounts[$loop->index]}} <br>
    **Quantity:** {{$quantities[$loop->index]}} <br>
    **Amount:** {{$quantities[$loop->index] * $amounts[$loop->index]}} <br>
@endforeach
<br><br>
**Address:**
{{$user->address}}
<br>
**Your Contact:**
{{$user->mobile_no}}
<br><br>
@component('mail::button', ['url' => route('your-order') ])
View all orders
@endcomponent

@component('mail::button', ['url' => route('home')])
Explore items
@endcomponent

**Thanks,**<br>
**{{ config('app.name') }}**
@endcomponent
