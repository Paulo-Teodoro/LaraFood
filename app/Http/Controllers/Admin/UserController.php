<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanRequest;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;

        $this->middleware(['can:Usuarios']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->latest()->tenantUser()->paginate();

        return view('admin.pages.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUserRequest $request)
    {
        $tenant = auth()->user()->tenant;
        $data = $request->all();
        $data['tenant_id'] = $tenant->id;
        $data['password'] = Hash::make($data['password']);

        $this->repository->create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$user = $this->repository->tenantUser()->find($id))
        return redirect()->back();

        return view('admin.pages.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$user = $this->repository->tenantUser()->find($id))
            return redirect()->back();

        return view('admin.pages.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUserRequest $request, $id)
    {
        if(!$user = $this->repository->tenantUser()->find($id))
            return redirect()->back();

        $data = $request->only(['name', 'email']);   
        
        if($request->password) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$user = $this->repository->tenantUser()->find($id))
            return redirect()->back();

        $user->delete();  
        
        return redirect()->route('users.index');
    }

    /**
     * Search results
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) 
    {
        $filters = $request->except('_token');
        $users = $this->repository->search($request->filter);

        return view('admin.pages.users.index', [
            'users' => $users,
            'filters' => $filters
        ]);
    }
}
