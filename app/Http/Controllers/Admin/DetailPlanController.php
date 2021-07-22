<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlanRequest;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    private $repository;
    private $plan;

    public function __construct(DetailPlan $detailPlan,Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idPlan)
    {
        if(!$plan = $this->plan->find($idPlan)) {
            return redirect()->back();
        } 

        $details = $plan->details()->get();

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idPlan)
    {
        if(!$plan = $this->plan->find($idPlan)) {
            return redirect()->back();
        } 
        return view('admin.pages.plans.details.create', [
            'plan' => $plan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateDetailPlanRequest $request, $idPlan)
    {
        if(!$plan = $this->plan->find($idPlan)) {
            return redirect()->back();
        } 

        $plan->details()->create($request->all());

        return redirect()->route('details.plan.index', [
            $plan->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idPlan, $idDetail)
    {
        $plan = $this->plan->find($idPlan);
        $detail = $this->repository->find($idDetail);

        if(!$plan || !$detail) {
            return redirect()->back();
        } 
        return view('admin.pages.plans.details.show', [
            'plan' => $plan,
            'detail' => $detail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idPlan,$idDetail)
    {
        $plan = $this->plan->find($idPlan);
        $detail = $this->repository->find($idDetail);

        if(!$plan || !$detail) {
            return redirect()->back();
        } 
        return view('admin.pages.plans.details.edit', [
            'plan' => $plan,
            'detail' => $detail
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateDetailPlanRequest $request, $idPlan, $idDetail)
    {
        $plan = $this->plan->find($idPlan);
        $detail = $this->repository->find($idDetail);

        if(!$plan || !$detail) {
            return redirect()->back();
        } 

        $detail->update($request->all());

        return redirect()->route('details.plan.index', [
            $plan->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idPlan, $idDetail)
    {
        $plan = $this->plan->find($idPlan);
        $detail = $this->repository->find($idDetail);

        if(!$plan || !$detail) {
            return redirect()->back();
        } 

        $detail->delete;

        return redirect()->route('details.plan.index', [
            $plan->id
        ])->with('message', 'Registro deletado com sucesso');
    }
}
