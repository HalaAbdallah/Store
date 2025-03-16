@extends('layouts.admin')

@section('content')
    <div>

        <!-- Button to add a new category -->
        <div class="mb-3 py-3">
            <a href="{{ route('categories.create') }}" class="btn btn-success">أضف صنف جديد</a>
        </div>

        <!-- Table to display the list of categories -->
        <table class="table table-striped table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th>#</th> <!-- Auto-incremented serial number -->
                    <th>اسم الصنف</th> <!-- Column for category names -->
                    <th>الأحداث</th> <!-- Column for edit and delete actions -->
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <!-- Loop through all categories -->
                    <tr>
                        <td>{{ $loop->iteration }}</td> <!-- Auto-incremented row number -->
                        <td>{{ $category->name }}</td> <!-- Display category name -->

                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <!-- Edit Button -->
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">
                                    تعديل
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this category?');">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
