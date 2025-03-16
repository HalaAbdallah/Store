@extends('layouts.admin')

@section('content')
    <div class="py-3">
        <!-- Product Update Form -->
        <form action="{{ url('admin/products/update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Product Name Input -->
            <div class="mb-3">
                <label for="name" class="form-label">اسم المنتج</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
            </div>

            <!-- Product Price Input -->
            <div class="mb-3">
                <label for="price" class="form-label">السعر</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
            </div>

            <!-- Product Quantity Input -->
            <div class="mb-3">
                <label for="quantity" class="form-label">الكمية</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}">
            </div>

            <!-- Product Description Input -->
            <div class="mb-3">
                <label for="description" class="form-label">الوصف</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
            </div>

            <!-- Category Selection Dropdown -->
            <div class="mb-3">
                <label for="categoryFormControlTextarea1" class="form-label">اختر الفئة</label>
                <select name="category" id="category" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">حفظ التعديلات</button>
        </form>
    </div>
@endsection
