@extends('layouts.admin')
@section('content')
    <div>

        <!-- Button to add a new product -->
        <div class="mb-3 py-3">
            <a href="{{ route('products.create') }}" class="btn btn-success">أضف منتج جديد</a>
        </div>

        <!-- Table to display the list of products -->
        <table class="table table-striped table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>اسم المنتج</th>
                    <th>الصنف</th>
                    <th>السعر</th>
                    <th>الكمية</th>
                    <th>الأحداث</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>رقم المنتج{{ $loop->iteration }}</td> <!-- This auto-increments -->
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category ? $product->category->name : 'لا يوجد صنف' }}</td>
                        <td>{{ $product->price }}$</td>
                        <td>{{ $product->quantity }}</td>

                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <!-- Edit Button -->
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">تعديل</a>

                                <!-- Delete Button -->
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
