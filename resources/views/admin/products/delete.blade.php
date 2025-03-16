<!-- Product Deletion Form -->
<form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE') <!-- Spoofing DELETE request as HTML forms only support GET & POST -->

    <!-- Delete Button with Confirmation -->
    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">حذف</button>
</form>

