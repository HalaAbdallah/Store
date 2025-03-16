<!-- Delete Button inside the categories list -->
<form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE') <!-- Specifies the request method as DELETE -->

    <!-- Delete Button with Confirmation -->
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف هذا الصنف؟')">
        حذف
    </button>
</form>
