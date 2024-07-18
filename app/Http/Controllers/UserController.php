<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUserRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
    public function show(string $userId)
    {
         $user  =  $this->userService->getUser($userId);
        if (!$user) abort(ResponseAlias::HTTP_NOT_FOUND);

        return view('users.show' , ['user' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $userId)
    {
        $user  =  $this->userService->getUser($userId);
        if (!$user) abort(ResponseAlias::HTTP_NOT_FOUND);

        return view('users.edit' , ['user' => $user]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUserRequest $request, string $userId)
    {
        try{
            DB::beginTransaction();

            $user  =  $this->userService->getUser($userId);
            if (!$user) abort(ResponseAlias::HTTP_NOT_FOUND);

            $this->userService->updateUser($request->validated() , $userId);

            return redirect()->route('users.index')->with(['error' => 'Successfully Updated User ']);

            }catch (\Exception $exception){

            DB::rollBack();

            return back()->with(['error' => $exception->getMessage()]);

        }
    }

    /**
     * Remove the specified resource from storage.
     * @param string $userId
     * @return RedirectResponse
     */
    public function destroy(string $userId)
    {
        try{

            $user  =  $this->userService->getUser($userId);
            if (!$user) abort(ResponseAlias::HTTP_NOT_FOUND);

            $this->userService->deleteUser($userId);

            return back()->with(['success' => 'User deleted successfully']);

        }catch(\Exception $exception){

            return back()->with(['error' => 'User could not be deleted reason: ' .$exception->getMessage()]);
        }

    }
}
