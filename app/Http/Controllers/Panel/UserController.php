<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\Repository;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = new Repository($user);
    }

    public function index()
    {
        $users = $this->user->all();
        return $users;
    }

    public function store(UserRequest $request)
    {
        // هر چیزی داخل filable مدل هس رو ذخیره کن
        return $this->user->create($request->only($this->user->getModel()->fillable));
    }
}
