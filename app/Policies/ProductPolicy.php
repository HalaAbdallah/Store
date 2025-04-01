<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // إذا أردت السماح للجميع بمشاهدة المنتجات، يمكن تعديل هذه الدالة كما هو مطلوب.
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        // السماح للمستخدم بمشاهدة المنتج إذا كان هو نفسه مالك المنتج.
        return $user->id === $product->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // السماح للمستخدمين المسجلين فقط بإنشاء منتج جديد.
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        // السماح فقط للمستخدم الذي يملك المنتج بتعديله.
        return $user->id === $product->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        // السماح فقط للمستخدم الذي يملك المنتج بحذفه.
        return $user->id === $product->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        // إذا كنت ترغب في السماح باسترجاع المنتج، يمكن تعديل هذه الدالة.
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        // إذا كنت ترغب في السماح بالحذف بشكل نهائي، يمكن تعديل هذه الدالة.
        return false;
    }
}
