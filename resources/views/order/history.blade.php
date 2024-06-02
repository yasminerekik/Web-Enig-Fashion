@extends('layout')

<style>
    .welcome-heading2 {
        font-size: 1.25em;
        color: #0F2649;
        font-weight: bold;
    }

    .welcome-heading3 {
        font-size: 3em;
        color: #0F2649;
        font-weight: bold;
    }

    .welcome-heading1 {
        font-size: 4.5em;
        color: #0F2649;
        font-weight: bold;
    }
</style>

@section('content')

<div class="container shadow">
    <h1 class="welcome-heading1"><center>Your order</center></h1>
    <div class="table-responsive">
        <table class="table table-bordered rounded">
            <thead> <!-- tete du tableau -->
                <tr>
                    <th class ="welcome-heading2" style = "background-color: #B0C9CD">Order</th>
                    <th class ="welcome-heading2" style = "background-color: #B0C9CD">Total Amount</th>
                    <th class ="welcome-heading2" style = "background-color: #B0C9CD">Action</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>
                @foreach ($userOrders as $order)
                <tr>
                    <td class ="welcome-heading2" style = "background-color: #B0C9CD">{{ $order->product->name }}[{{ $order->product->description }}]({{ $order->quantity }})</td>
                    <td class ="welcome-heading2" style = "background-color: #B0C9CD">{{ $order->total_amount }} DT</td>
                    <td style = "background-color: #B0C9CD">
                        @if ($order->status == 'completed')
                        <form method="POST" action="{{ route('orders.delete', ['order' => $order->id]) }}">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="btn btn-danger btn-action btn-delete welcome-heading2">
                       <i class="fas fa-trash-alt"></i> Delete
                       </button>
                       </form>
                        @endif
                    </td>
                </tr>
                @endforeach
                <!-- Bouton Valider -->
                <tr>
                    <td colspan="3" class="text-center" style = "background-color: #F5F3EC"> <!-- colspan="3" besh tna77i la3ross ta3 tableau w tji fel west -->
                        <a href="{{ route('order.create') }}" class="btn btn-primary welcome-heading2">Validate</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
