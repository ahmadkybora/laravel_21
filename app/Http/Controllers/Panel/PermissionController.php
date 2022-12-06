<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Traits\FilterTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\PermissionRequest;
use App\Models\User;

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

        // $this->users = $this->filter($request, $this->user, $this->filter);

        // if($this->users)
            return response()->json([
                'state' => true,
                'message' => __('general.success'),
                'data' => Permission::all(['id', 'name'])
            ], 200);
    }

    /**
     * Store a newly created resource in storage.   
     *
     * @param  \App\Http\Requests\PermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);
        foreach($request->input('permissions') as $index => $permission) {
            $user->givePermissionTo($permission);
        }
        return response()->json([
            'state' => true,
            'message' => __('general.success'),
            'data' => ''
        ], 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $user)
    {
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
     * @param  \App\Http\Requests\PermissionRequest  $request
     * @param  \App\Models\Permission  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
