<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Topic;
use App\Models\User;

class CategoriesController extends Controller
{
    //
    public function show(Category $category,Request $request, Topic $topic, User $user)
    {
        // 读取分类id关联的话题，并按每20条一组
        $topics = $topic->withOrder($request->order)->where('category_id',$category->id)->paginate(20);
        $active_users = $user->getActiveUsers();
        return view('topics.index',compact('topics','category','active_users'));
    }
}
