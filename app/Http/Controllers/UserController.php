<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
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
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function index()
    {

        $users  =  $this->userService->getUsersByDesc();

         return view('users.index',  ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     * @param PostUserRequest $request
     * @return RedirectResponse
     */
    public function store(PostUserRequest $request)
    {
        DB::beginTransaction();

        try{

            $this->userService->createUser($request->validated());

            DB::commit();

            Alert::success('User Creation' , 'user created successfully');

            return back();

        }catch (\Exception $exception){
             DB::rollBack();

            Alert::error('User Creation' , ' error '.$exception->getMessage());

            return back();

        }

    }

    /**
     * Display the specified resource.
     * @param string $userId
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function show(string $userId)
    {
         $user  =  $this->userService->getUser($userId);
        if (!$user) abort(ResponseAlias::HTTP_NOT_FOUND);

        return view('users.show' , ['user' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     * @param string $userId
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function edit(string $userId)
    {
        $user  =  $this->userService->getUser($userId);
        if (!$user) abort(ResponseAlias::HTTP_NOT_FOUND);

        return view('users.edit' , ['user' => $user]);

    }

    /**
     * Update the specified resource in storage.
     * @param UpdateUserRequest $request
     * @param string $userId
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, string $userId)
    {
        try{
                DB::beginTransaction();

                $user  =  $this->userService->getUser($userId);
                if (!$user) abort(ResponseAlias::HTTP_NOT_FOUND);

                $this->userService->updateUser($request->validated() , $userId);

                DB::commit();

                Alert::success('User Updated' , 'user updated successfully');

                return redirect()->route('users.index');

            }catch (\Exception $exception){
                DB::rollBack();

                Alert::error('Updating User' , 'user failed to update' . $exception->getMessage());

                return back();
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

            if($user->allocation){
                Alert::error('User Deletion' , 'failed to delete user because its already assigned to a equipment');
                return back();
            }

            $this->userService->deleteUser($userId);

            Alert::success('User Deletion' , 'user deleted successfully');

            return back();

        }catch(\Exception $exception){

            Alert::success('User Deletion' , 'failed to delete user '.$exception->getMessage());

            return back();
        }

    }
}
