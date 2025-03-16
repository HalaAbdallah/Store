@extends('layouts.admin')

@section('content')
    <div class="py-3">
        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Product creation form -->
        <form action="{{ route('products.store') }}" method="post">
            @csrf
            <!-- Product Name Input -->
            <div class="mb-3">
                <label for="nameFormControlInput1" class="form-label">اسم المنتج</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="اسم المنتج"
                    value="{{ old('name') }}">
                <!-- Show error message for name -->
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Product Quantity Input -->
            <div class="mb-3">
                <label for="quantityFormControlInput1" class="form-label">الكمية</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="كمية المنتج"
                    value="{{ old('quantity') }}">
                <!-- Show error message for quantity -->
                @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Product Price Input -->
            <div class="mb-3">
                <label for="priceFormControlInput1" class="form-label">السعر</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="السعر"
                    value="{{ old('price') }}">
                <!-- Show error message for price -->
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Product Description Input -->
            <div class="mb-3">
                <label for="descriptionFormControlTextarea1" class="form-label">الوصف</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                <!-- Show error message for description -->
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category Selection Dropdown -->
            <div class="mb-3">
                <label for="categoryFormControlTextarea1" class="form-label">اختر الفئة</label>
                <select name="category" id="category" class="form-control">
                    <option value="">اختر الفئة</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <!-- Show error message for category -->
                @error('category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <input type="submit" value="احفظ" class="btn btn-info">
            </div>
        </form>
    </div>
@endsection
