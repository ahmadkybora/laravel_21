<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\Repository;
use App\Filters\Filter;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    protected $user;
    protected $filter;
    public function __construct(User $user)
    {
        $this->user = new Repository($user);
        // $this->filter = new Filter($user);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $users = $this->filter->filterByAll($request);
        // dd(count(array_keys($request->filter)));
        // for($i = 0; $i < count(array_keys($request->filter)); $i++) {
        //     // dd($i);
        // $users = QueryBuilder::for(User::class)
        //     ->allowedFilters([array_keys($request->filter)[$i]])
        //     ->get();
        // }
        // dd($this->user);
        // $users = $this->user->where([]);
        return response()->json([
            'state' => true,
            'message' => __('general.success'),
            'data' => $this->user->all(),
        ], 200);
    }

    public function store(UserRequest $request)
    {
        // هر چیزی داخل filable مدل هس رو ذخیره کن
        return $this->user->create($request->only($this->user->getModel()->fillable));
    }
}
