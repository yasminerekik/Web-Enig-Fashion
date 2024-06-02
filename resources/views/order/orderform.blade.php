@extends('layouta') 
<style>
    .welcome-heading3 {
            font-size: 3em;
            color: #0F2649;
            font-weight: bold;
        }
    .welcome-heading2 {
            font-size: 1.25em;
            color: #0F2649;
            font-weight: bold;
        }
        </style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"> 
               <div class="card border-1 shadow">
                <div class="card" style = "background-color: #B0C9CD">
                    <div class="card-header">
                        <h1 class="text-center welcome-heading3">Order Form</h1>
                    </div>
                    <div class="card-body">
                        <p class="text-center welcome-heading2">Product: {{ $product->name }}</p>
                        <form action="{{ route('submit.order', $product->id) }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="quantity" class="col-md-4 col-form-label text-md-right welcome-heading2">Quantity:</label>
                                <div class="col-md-6">
                                    <input type="number" name="quantity" id="quantity" class="form-control welcome-heading2" required>
                                </div>
                            </div>
                            <br>
                            <!-- Add other fields as needed -->
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary welcome-heading2">Submit Order</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
