<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\Repository;
use App\Filters\Filter;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Traits\FilterTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use FilterTrait;

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
        if(Gate::denies('view-any', User::class))
            return response()->json([
                'state' => false,
                'message' => __('general.accessDenied'),
                'data' => null,
            ], 403);

        $this->users = $this->filter($request, $this->user, $this->filter);
        if($this->users)
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => $this->users
            ], 200);

        // if(Gate::denies('view-any', User::class))
        // {
        //     return response()->json([
        //         'state' => false,
        //         'message' => __('general.accessDenied'),
        //         'data' => null,
        //     ], 403);
        // }

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

        // if($request->query('filter')) {
        //     $this->users = $this->filter->filterByOneColumn($request);
        // } else if($request->query('include')) {
        //     $this->users = $this->filter->filterByRelationship($request);
        // } else if($request->query('sort')) {
        //     $this->users = $this->filter->filterBySort($request);
        // } else if($request->query('fields')) {
        //     $this->users = $this->filter->filterByMultiColumn($request);
        // } else if($request->query('all')) {
        //     $this->users = $this->user->all();
        // } else if($request->query('allAndPaginate')) {
        //     $this->users = User::select('id', 'first_name', 'last_name', 'username', 'email')
        //         ->paginate($request->query('allAndPaginate'));
        // }

        // $this->users = $this->filters = QueryBuilder::for(User::class)
        //     ->allowedFilters(['first_name'])
            // ->allowedFilters([AllowedFilter::exact('username'), AllowedFilter::exact('email')])
            // ->get();
            // ->paginate($request->query('paginate'));


        // if($request->query('allAndPaginate'))
        //     $this->users = User::select('id', 'first_name', 'last_name', 'username', 'email')
        //         ->paginate($request->query('allAndPaginate'));

        // foreach($this->users as $key => $index) {
        //     dd($index['email']);
        // }
        // dd($this->users);
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
        // return $this->user->create($request->only($this->user->getModel()->fillable));

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->postal_code = $request->input('postal_code');
        $user->home_address = $request->input('home_address');
        $user->work_address = $request->input('work_address');
        $user->secret_key = rand(1,9);
        $user->password = Hash::make($request->input('password'));
        if($request->hasFile('avatar'))
        {
            $path = Storage::disk('public')->putFile('images/avatars', $request->file('avatar'));
            if (!empty($user->avatar_uri) and file_exists('storage/' . $user->avatar_uri));
            Storage::disk('public')->delete($user->avatar_uri);
            $user->avatar_uri = $path;
        }

        if($user->save())
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => null,
            ], 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(Gate::denies('view', $user))
            return response()->json([
                'state' => false,
                'message' => __('general.accessDenied'),
                'data' => null,
            ], 403);

        if($user)
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => $user,
            ], 200);
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
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->mobile = $request->input('mobile');
        $user->postal_code = $request->input('postal_code');
        $user->home_address = $request->input('home_address');
        $user->work_address = $request->input('work_address');
        if($request->hasFile('avatar'))
        {
            $path = Storage::disk('public')->putFile('images/avatars', $request->file('avatar'));
            if (!empty($user->avatar_uri) and file_exists('storage/' . $user->avatar_uri));
            Storage::disk('public')->delete($user->avatar_uri);
            $user->avatar_uri = $path;
        }

        if($user->save())
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => null,
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete())
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => null,
            ], 200);
    }
}
