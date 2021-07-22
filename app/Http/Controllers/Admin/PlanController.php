<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = $this->repository->latest()->paginate();

        return view('admin.pages.plans.index', [
            'plans' => $plans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdatePlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePlanRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = $this->repository->find($id);

        if(!$plan)
            return redirect()->back();

        return view('admin.pages.plans.show', [
            'plan' => $plan
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
        $plan = $this->repository->find($id);

        if(!$plan)
            return redirect()->back();

        return view('admin.pages.plans.edit', [
            'plan' => $plan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdatePlanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePlanRequest $request, $id)
    {
        $plan = $this->repository->find($id);

        if(!$plan)
            return redirect()->back();

        $plan->update($request->all());  
        
        return redirect()->route('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = $this->repository
                        ->with('details')
                        ->find($id);

        if(!$plan)
            return redirect()->back();

        if($plan->details->count() > 0) {
            return redirect()
                            ->back()
                            ->with('error', 'Existem detalhes vinculados a esse plano, portanto não é possivel deletar');
        }

        $plan->delete();    

        return redirect()->route('plans.index');
    }

    public function search(Request $request) {
        $filters = $request->except('_token');
        $plans = $this->repository->search($request->name);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters
        ]);
    }
}
