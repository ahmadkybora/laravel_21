<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\Repository;
use App\Filters\Filter;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        // $this->user = new Repository($user);
        $this->user = new Filter($user);
    }

    public function index(Request $request)
    {
        // dd($this->user);
        $users = $this->user->where('name', 'Rowan Hand');
        return response()->json([
            'state' => true,
            'message' => __('general.success'),
            'data' => $users,
        ], 200);
    }

    public function store(UserRequest $request)
    {
        // هر چیزی داخل filable مدل هس رو ذخیره کن
        return $this->user->create($request->only($this->user->getModel()->fillable));
    }
}
