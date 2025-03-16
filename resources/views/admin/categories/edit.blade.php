@extends('layouts.admin')

@section('content')
    <div class="py-3">
        <!-- Category Update Form -->
        <form action="{{ url('admin/categories/update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Category Name Input Field -->
            <div class="mb-3">
                <label for="name" class="form-label">اسم الصنف</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
            </div>

            <!-- Submit Button to Save Changes -->
            <button type="submit" class="btn btn-success">حفظ التعديلات</button>
        </form>
    </div>
@endsection
