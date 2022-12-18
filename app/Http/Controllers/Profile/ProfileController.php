<?php

namespace App\Http\Controllers\Profile;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $profile = auth()->user();
        if($profile)
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => $profile,
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        $profile = $request->user();
        dd($profile->tickets);
        $profile->first_name = $request->input('first_name');
        $profile->last_name = $request->input('last_name');
        $profile->mobile = $request->input('mobile');
        $profile->postal_code = $request->input('postal_code');
        $profile->home_address = $request->input('home_address');
        $profile->work_address = $request->input('work_address');
        if($request->hasFile('avatar'))
        {
            $path = Storage::disk('public')->putFile('images/avatars', $request->file('avatar'));
            if (!empty($profile->avatar_uri) and file_exists('storage/' . $profile->avatar_uri));
            Storage::disk('public')->delete($profile->avatar_uri);
            $profile->avatar_uri = $path;
        }

        if($profile->save())
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => null,
            ], 200);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if (Hash::check($request->input('current_password'), $request->user()->password))
        {
            $user->password = Hash::make($request->input('password'));
            if ($user->save())
            {
                return response()->json([
                    'state' => true,
                    'message' => "your password successfully changed!",
                    'data' => null,
                ], 200);
            }
        }

    }
}
