<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Http\Requests\SkillUserRequest;
use App\Http\Requests\UserRequest;
use App\Mail\UserInvitation;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->email = $request->email;
        if($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        if($request->has('name')) {
            $user->name = $request->name;
        }
        $user->save();
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // $user->update($request->except('email'));
        if($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        if($request->has('name')) {
            $user->name = $request->name;
        }
        $user->save();
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function invite(InvitationRequest $request, User $user) {

        $userToInvite = User::FirstOrCreate(['email' => $request->email]);
        Mail::to($userToInvite)->send(new UserInvitation($user->name));
        $invitation = $user->invitations()->create([
            'user_invited_id' => $userToInvite->id,
        ]);

        return response()->json($invitation, 201);
    }

    public function invitations(User $user) {
        return response()->json($user->invitations, 200);
    }
}
