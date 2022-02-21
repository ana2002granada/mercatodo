<?php

namespace App\Http\Controllers\Guest;

use App\Actions\Category\CategoryShowAction;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoriesControllerGuest extends Controller
{
    public function show(Category $category): View
    {
        return view('guest.categories.show', CategoryShowAction::execute($category));
    }
}
