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
    protected $users = [];
    protected $filter;
    
    public function __construct(User $user)
    {
        // $f = new Filter();
        // dd($f);
        $this->user = new Repository($user);
        $this->filter = new Filter(User::class);
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
        // return response()->json([
        //     'state' => true,
        //     'message' => __('general.success'),
        //     'data' => $this->user->all(),
        // ], 200);
        // dd($request->query('paginate'));
        // $users = $this->filter->filterByAll($request);
        // return $users;
        // $users = [];

        //         if($request->query('sort'))
        // dd(array_keys($request->query('filter'))[0]);
        // if($request->query('sort'))
        //     $users = QueryBuilder::for(User::class)
        //         // ->allowedFilters(array_keys($request->query('filter'))[0])
        //         ->allowedSorts('id')
        //         ->get();

            // $users = (new Search())
            //     ->registerModel(User::class, 'name')
            //     ->search('john');

            // $users = User::where('username', 'LIKE', '%' . $request->query('search') . '%')
            //     ->select('id', 'first_name', 'last_name', 'username', 'email')
            //     ->latest()
            //     ->paginate(10);

        if($request->query('filter'))
            $this->users = $this->filter->filterByOneColumn($request);

        if($request->query('include'))
            $this->users = $this->filter->filterByRelationship($request);

        if($request->query('fields'))
            $this->users = $this->filter->filterByMultiColumn($request);

        if($request->query('sort'))
            $this->users = $this->filter->filterBySort($request);

        if($request->query('all'))
            $this->users = $this->user->all();

        if($request->query('allAndPaginate'))
            $this->users = User::select('id', 'first_name', 'last_name', 'username', 'email')
                ->paginate($request->query('allAndPaginate'));

        if($this->users)
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => $this->users
            ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // هر چیزی داخل filable مدل هس رو ذخیره کن
        return $this->user->create($request->only($this->user->getModel()->fillable));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
