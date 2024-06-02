@extends('layouta')
<style>
    /* Ajoutez vos styles CSS personnalisés ici */
    .orders-section {
        margin-top: 20px;
    }

    .orders-list {
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
    }

    .order-item {
        margin-bottom: 15px;
    }

    .order-item p {
        margin: 5px 0;
    }

    .form-item {
        margin-bottom: 15px;
    }

    .submit-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .submit-button:hover {
        background-color: #45a049;
    }
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
        <!-- Add Product Form in a Table -->
        <div class="mb-4">
            <h2 class ="welcome-heading3">Add Product</h2>
            <table class="table welcome-heading2">
                <tr>
                    <td>
                        <form method="post" action="{{ route('seller.products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 welcome-heading2">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3 welcome-heading2">
                                <label for="description" class="form-label">Product Description</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <div class="mb-3 welcome-heading2">
                                <label  for="price" class="form-label">Product Price</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label welcome-heading2">Product Image</label>
                                <input type="file" class="form-control welcome-heading2" id="image" name="image">
                            </div>
                            <div class="mb-3">
                                <label for="categorie" class="form-label welcome-heading2">Product Category</label>
                                <select class="form-control welcome-heading2" id="categorie" name="categorie" required>
                                    <option value="women">Women</option>
                                    <option value="men">Men</option>
                                    <option value="kids">Kids</option>
                                </select>
                            </div>
                            <!-- Nouveaux champs pour la promotion -->
                            <div class="mb-3 welcome-heading2">
                                <label for="promotion_percentage" class="form-label">Promotion Percentage</label>
                                <input type="number" class="form-control welcome-heading2" id="promotion_percentage" name="promotion_percentage" min="0" max="100">
                            </div>
                            <div class="mb-3">
                                <label for="promotion_start_date" class="form-label welcome-heading2">Promotion Start Date</label>
                                <input type="date" class="form-control welcome-heading2" id="promotion_start_date" name="promotion_start_date">
                            </div>
                            <div class="mb-3">
                                <label for="promotion_end_date" class="form-label welcome-heading2">Promotion End Date</label>
                                <input type="date" class="form-control welcome-heading2" id="promotion_end_date" name="promotion_end_date">
                            </div>
                            <!-- Fin des nouveaux champs pour la promotion -->
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Display existing products in a Table -->
        <div class="mb-4">
            <h2 class ="welcome-heading3">Products</h2>
            <table class="table welcome-heading2">
                <!-- Table Header -->
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }} DT</td>
                            <td>
                                @if ($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" style="max-width: 50px;">
                                @endif
                            </td>
                            <td>
                                <!-- Update Product Form in a Table -->
                                <form method="post" action="{{ route('seller.products.update', $product->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="editName" class="form-label">Edit Product Name</label>
                                        <input type="text" class="form-control welcome-heading2" id="editName" name="name" value="{{ $product->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editDescription" class="form-label">Edit Product Description</label>
                                        <textarea class="form-control welcome-heading2" id="editDescription" name="description" required>{{ $product->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPrice" class="form-label">Edit Product Price</label>
                                        <input type="number" class="form-control welcome-heading2" id="editPrice" name="price" value="{{ $product->price }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editImage" class="form-label">Upload New Image</label>
                                        <input type="file" class="form-control welcome-heading2" id="editImage" name="image">
                                    </div>
                                    <!-- Champ de promotion éditable -->
                                    <div class="mb-3">
                                        <label for="editPromotionPercentage" class="form-label">Edit Promotion Percentage</label>
                                        <input type="number" class="form-control welcome-heading2" id="editPromotionPercentage" name="promotion_percentage" value="{{ $product->promotion_percentage }}" min="0" max="100">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPromotionStartDate" class="form-label">Edit Promotion Start Date</label>
                                        <input type="date" class="form-control welcome-heading2" id="editPromotionStartDate" name="promotion_start_date" value="{{ $product->promotion_start_date }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPromotionEndDate" class="form-label">Edit Promotion End Date</label>
                                        <input type="date" class="form-control welcome-heading2" id="editPromotionEndDate" name="promotion_end_date" value="{{ $product->promotion_end_date }}">
                                    </div>
                                    <!-- Fin du champ de promotion éditable -->
                                    <button type="submit" class="btn btn-warning">Update Product</button>
                                </form>
                                
                                <!-- Delete Product Form -->
                                <form method="post" action="{{ route('seller.products.delete', $product->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete Product</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mb-4 p-3 rounded" style="border: 2px solid #ddd;">
<div class="orders-section">
    <h2 class ="welcome-heading3" >Orders</h2>
    <div class="orders-list" style="background-color:#E9E0D9;">
        @php
            $ordersExist = false;
        @endphp
        @foreach ($orders as $order)
            @if ($order->product->user_id == Auth::id())
                @php
                    $ordersExist = true;
                    $productName = $order->product->name;
                    $productQuantity = $order->quantity;
                    $productDescription = $order->product->description;
                @endphp
                <div class="order-item">
                    <p class ="welcome-heading2">{{ $order->user->name }} ordered {{ $productQuantity }} of your product "{{ $productName }}".</p>
                    <p class ="welcome-heading2">Description: {{ $productDescription }}</p>
                    <!-- Add other order details as needed -->
                </div>
            @endif
        @endforeach
        @if ($ordersExist)
        <form method="POST" action="/mark-form-as-seen" class="order-form">
            @csrf
            @foreach ($forms as $form)
                <div class="form-item welcome-heading2">
                    <p class ="welcome-heading2">Last Name: {{ $form->nom }}</p>
                    <p class ="welcome-heading2">First Name: {{ $form->prenom }}</p>
                    <p class ="welcome-heading2">Address: {{ $form->adresse }}</p>
                    <p class ="welcome-heading2">Contact: {{ $form->contact }}</p>
                    <p class ="welcome-heading2">Feedback: {{ $form->feedback }}</p>
                    <p class ="welcome-heading2">Emoji: {{ $form->emoji }}</p>
                    <!-- Ajoutez une case à cocher pour indiquer que le vendeur a vu ce formulaire -->
                    <input type="checkbox" name="seen_forms[]" value="{{ $form->id }}">
                </div>
            @endforeach
            <button type="submit" class="submit-button">Confirm Orders Received</button>
        </form>
        @endif
    </div>
</div>
    </div>
@endsection