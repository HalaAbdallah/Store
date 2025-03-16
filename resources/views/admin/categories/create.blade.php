@extends('layouts.admin')

@section('content')
    <div class="py-3">
        <!-- Category creation form -->
        <form action="{{ route('categories.store') }}" method="post">
            @csrf

            <!-- Category Name Input -->
            <div class="mb-3">
                <label for="name" class="form-label">اسم الصنف</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="ادخل اسم الصنف">
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <input type="submit" value="حفظ" class="btn btn-info">
            </div>
        </form>
    </div>
@endsection
