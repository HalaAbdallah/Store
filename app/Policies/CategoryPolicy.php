<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // يمكن لأي مستخدم عرض الفئات
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        return true; // يمكن لأي مستخدم عرض فئة معينة
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // يمكن لأي مستخدم إنشاء فئة جديدة
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        // يمكن للمستخدم التعديل إذا كان هو نفسه من أنشأ الفئة
        return $user->id === $category->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        // يمكن للمستخدم الحذف إذا كان هو نفسه من أنشأ الفئة
        return $user->id === $category->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Category $category): bool
    {
        return false; // إذا كنت لا تحتاج لاستعادة الفئات المحذوفة
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        return false; // إذا كنت لا تحتاج لحذف الفئات بشكل نهائي
    }
}
