@extends('layout')

@section('content')

    <h1 class="welcome-heading1"><center>Women Catalog</center></h1>

    <!-- Search Form -->
    <form action="{{ route('products.category', ['category' => 'women']) }}" method="GET" style="margin-bottom: 20px;"><center>
        <label class ="welcome-heading2" for="min_price">Min Price:</label>
        <input class ="welcome-heading2" type="number" name="min_price" id="min_price" value="{{ $minPrice }}" min="0" style="border-radius: 8px; padding: 8px; border: 2px solid #d3d3d3;">

        <label class ="welcome-heading2" for="max_price">Max Price:</label>
        <input class ="welcome-heading2" type="number" name="max_price" id="max_price" value="{{ $maxPrice }}" min="0" style="border-radius: 8px; padding: 8px; border: 2px solid #d3d3d3;">
        <input class ="welcome-heading2" type="text" name="query" placeholder="Search products" value="{{ $query }}" style="border-radius: 8px; padding: 8px; border: 2px solid #d3d3d3;">
        <button class ="welcome-heading2" type="submit" style="border-radius: 8px; padding: 8px; border: 2px solid #d3d3d3; background-color: #f5f5f5; cursor: pointer;">Search</button>
    </center></form>
    <br>
    <!-- Product Gallery -->
    <div class="product-gallery">
        @foreach ($products as $product)
            <div class="product-item">
                <!-- Product Details -->
                <div class="product-details">
                    <br>
                    <h1 class="welcome-heading3"><center>{{ $product->name }}</center></h1>
                    <p class="description welcome-heading2">Description: {{ $product->description }}</p>
                    <p class="price welcome-heading2">Price: {{ $product->price }}dt</p>
                    <p class="comments welcome-heading2">Comments: {{ $product->comments ?? 'No comments' }}</p>
                    <p class="ratings welcome-heading2">Ratings: {{ $product->ratings ?? 'No ratings' }}</p>

                    @if ($product->promotion_percentage)
                        <div class="promotion welcome-heading2">
                            <p><span class="discount welcome-heading2">{{ $product->promotion_percentage }}% off</span></p>
                            <p class="dates welcome-heading2">Valid: {{ $product->promotion_start_date }} to {{ $product->promotion_end_date }}</p>
                        </div>
                    @else
                        <p class="no-promotion welcome-heading2">No promotion</p>
                    @endif

                    <!-- Add Comment and Rating Form -->

                    <!-- Place Order Button -->
                    @if (!Auth::user()->hasRole('seller') || $product->user_id != Auth::id())
                    <form action="{{ route('products.comment', $product->id) }}" method="post" class="comment-form">
                        @csrf
                        <label class="welcome-heading2" for="comment">Add Comment:</label>
                        <textarea name="comment" id="comment" rows="2"></textarea>

                        <label class="welcome-heading2" for="rating">Rating:</label>
                        <input type="number" name="rating" id="rating" min="1" max="5">

                        <button class="welcome-heading2" type="submit" class="submit-button">Submit</button>
                    </form>
                    <br>
                        <form action="{{ route('orders.place', $product->id) }}" method="post" class="order-form">
                            @csrf
                            <button class = "welcome-heading2" type="submit" class="order-button">Place Order</button>
                        </form>
                    @endif
                </div>
                <!-- End Product Details -->

                <!-- Product Image -->
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="product-image" onclick="toggleDetails(this)">
            </div>
        @endforeach
    </div>

    <style>
        .product-gallery {
            display: flex; /* Transforme le conteneur en un conteneur flex, permettant ainsi un placement flexible des éléments enfants.*/
            flex-wrap: wrap; /*Permet aux éléments flexibles de s'enrouler sur plusieurs lignes si nécessaire, lorsque l'espace horizontal est insuffisant*/
            justify-content: center;
            gap: 40px; /* Augmentez l'espace entre les produits */
        }

        .product-item {
            position: relative; /*Définit la position de chaque élément .product-item comme relative par rapport à sa position normale dans le flux du document*/
            width: 250px; /* Ajustez la largeur des éléments du produit */
            height: 250px; /* Ajoutez cette ligne pour définir une hauteur fixe */
            text-align: center;
            margin-bottom: 40px; /* Augmentez l'espace en bas de chaque produit */
        }

        .product-image {
            max-width: 100%;
            width: 100%; /* Définir la largeur de l'image à 100% */
            height: 100%; /* Ajoutez cette ligne pour définir la hauteur à 100% */
            object-fit: cover; /* Ajoutez cette ligne pour couvrir entièrement le conteneur */
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s;
            z-index: 0; /* Assurez-vous que l'image est en arrière-plan */
        }

        .product-image:hover {
            transform: scale(1.1);
        }

        .product-details {
            background-color: #F5F3EC;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
            width: 90%;
            max-width: 300px;
            text-align: left;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out;
            margin-top: -20px; /* Décalage vers le haut pour cacher le début */
        }

        .product-details h3 {
            margin-top: 0;
            font-size: 1.5em;
            color: #333;
        }

        .product-details p {
            margin-bottom: 10px;
            font-size: 1em;
            color: #555;
        }

        .product-details .description {
            font-style: italic;
        }

        .product-details .price {
            font-weight: bold;
        }

        .product-details .comments, .product-details .ratings {
            font-style: italic;
            color: #777;
        }

        .product-details .promotion {
            margin-bottom: 10px;
        }

        .product-details .discount {
            color: #e74c3c;
            font-weight: bold;
        }

        .product-details .dates {
            font-size: 0.9em;
        }

        .product-details .no-promotion {
            font-style: italic;
            color: #777;
        }

        .comment-form label, .comment-form textarea, .comment-form input {
            width: 100%;
            margin-bottom: 10px;
            border-radius: 8px;
            padding: 8px;
            border: 2px solid #d3d3d3;
            background-color: #E9E0D9;
        }

        .comment-form .submit-button {
            background-color: #f5f5f5;
            cursor: pointer;
            border: none;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
        }

        .order-form .order-button {
            background-color: #f5f5f5;
            cursor: pointer; /*le curseur de la souris comme une main lorsqu'il survole le bouton, indiquant qu'il s'agit d'un élément cliquable*/
            border: none; /*sans bordure*/
            border-radius: 8px; /*arrondit les coins du bouton */
            padding: 10px; /* ajoute un espace de remplissage de 10 pixels à l'intérieur du bouton*/
            width: 100%; /* la largeur du bouton à 100% de la largeur de son conteneur parent*/
        }
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

    <script> /* pour gérer l'affichage des détails associés à une image lorsque celle-ci est cliquée*/
        var activeDetails = null; /*Cette variable sera utilisée pour suivre les détails actuellement affichés*/

        function toggleDetails(image) { /* Cette fonction est destinée à être appelée lorsqu'une image est cliquée*/
            var details = image.previousElementSibling;
            if (details.style.maxHeight === "0px" || details !== activeDetails) {
                if (activeDetails !== null) {
                    activeDetails.style.maxHeight = "0px";
                }
                details.style.maxHeight = details.scrollHeight + "px";
                activeDetails = details;
            } else {
                details.style.maxHeight = "0px";
                activeDetails = null;
            }
        }
    </script>
@endsection
