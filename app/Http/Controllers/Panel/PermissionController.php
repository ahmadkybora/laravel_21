<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Traits\FilterTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // use FilterTrait;

    // protected $user;
    // protected $users = [];
    // protected $filter;
    
    // public function __construct(User $user)
    // {
    //     // $f = new Filter();
    //     // dd($f);
    //     $this->user = new Repository($user);
    //     $this->filter = new Filter(User::class);
    // }

    /**
     * Display a listing of the resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->users = $this->filter($request, $this->user, $this->filter);

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
        if($user)
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => $user,
            ], 200);
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
