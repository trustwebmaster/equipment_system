<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users  =  $this->userService->getUsersByDesc();

         return view('users.index',  ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostUserRequest $request)
    {
        DB::beginTransaction();

        try{

            $this->userService->createUser($request->validated());

            DB::commit();

            return back()->with(['success' => 'User created successfully']);

        }catch (\Exception $exception){
             DB::rollBack();
            return back()->with(['error' => $exception->getMessage()]);

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
