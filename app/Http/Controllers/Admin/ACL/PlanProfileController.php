<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    protected $plan, $profile;

    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;

        $this->middleware(['can:Planos']);
    }
    
    public function profiles($idPlan)
    {
        $plan = $this->plan->find($idPlan);
        if(!$plan) {
            return redirect()->back();
        }

        $profiles = $plan->profiles()->paginate();    

        return view('admin.pages.plans.profiles.index', [
            'plan' => $plan,
            'profiles' => $profiles
        ]);
    }

    public function plans($idProfile)
    {
        $profile = $this->profile->find($idProfile);
        if(!$profile) {
            return redirect()->back();
        }

        $plans = $profile->plans()->paginate();
        return view('admin.pages.profiles.plans', [
            'profile' => $profile,
            'plans' => $plans
        ]);
    }

    public function profilesAvailable(Request $request, $idPlan)
    {
        if(!$plan = $this->plan->find($idPlan)){
            dd("erro");
            return redirect()->back(); 
        }
 
        $profiles = $plan->profilesAvailable($request->filter);    

        return view('admin.pages.plans.profiles.available', [
            'plan' => $plan,
            'profiles' => $profiles
        ]);
    }

    public function attachProfilesPlan(Request $request, $idPlan)
    {
        $plan = $this->plan->find($idPlan);
        if(!$plan) {
            return redirect()->back();
        }

        if(!$request->profiles || count($request->profiles) == 0) {
            return redirect()->back()->with('warning', 'Precisa escolher pelo menos uma permissão');
        }

        $plan->profiles()->attach($request->profiles); 

        return redirect()->route('plans.profiles', $plan->id);
    }

    public function detachProfilesPlan($idPlan, $idProfile)
    {
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);

        if(!$plan || !$profile ){
            return redirect()->back();
        }

        $plan->profiles()->detach($profile);

        return redirect()->route('plans.profiles', $plan->id);
    }
}
