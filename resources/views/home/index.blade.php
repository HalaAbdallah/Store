@extends('layouts.front')
@section('content')
    <!-- Category Selector -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">اختر الصنف</h2>
        <select id="categorySelect" class="form-select">
            <option value="">-- كل المنتجات --</option>
            @foreach ($categories as $category)
                <!-- Loop through categories and display them in the dropdown -->
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Product Listing -->
    <div class="container marketing mt-5">
        <div class="row" id="productList">
            <!-- Loop through products and display them -->
            @foreach ($products as $product)
                <!-- Each product is wrapped in a column and its category is stored in a data attribute -->
                <div class="col-lg-4 mb-4 product-item" data-category="{{ $product->category_id }}">
                    <div class="card shadow-sm">
                        <!-- Product image (50% width, centered) -->
                        <img src="{{ asset('download.png') }}" class="card-img-top w-50 mx-auto" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <!-- Button to view product details -->
                            <a href="#" class="btn btn-secondary">عرض التفاصيل</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- JavaScript for filtering products based on selected category -->
    <script>
        // Event listener to filter products based on selected category
        document.getElementById('categorySelect').addEventListener('change', function() {
            const selectedCategory = this.value;
            const productItems = document.querySelectorAll('.product-item');

            // Loop through all products and show/hide based on selected category
            productItems.forEach(item => {
                const productCategory = item.getAttribute('data-category');
                if (selectedCategory === '' || productCategory === selectedCategory) {
                    item.style.display = 'block'; // Show the product
                } else {
                    item.style.display = 'none'; // Hide the product
                }
            });
        });
    </script>
@endsection
