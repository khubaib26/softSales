<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Lead;
use App\Models\User;
use App\Models\LeadStatus;
use App\Models\UserCredit;
use Carbon\Carbon;
use Auth;
use DB;

class DashboardController extends Controller
{
    public function index(){
        
        // Current User Login
        $userId = Auth::user()->id;
        $isAdmin = true;
        if(!Auth::user()->hasRole('admin')){ $isAdmin = false; }

        // $posts = DB::table('posts')
        //     ->when(!$isAdmin, function ($query) use ($userId) {
        //         return $query->where('user_id', $userId);
        //     })
        // ->get();

        //Stats Functions
        $todayLeadsCount = DB::table('leads')->whereDate('created_at', Carbon::today())
        ->when(!$isAdmin, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
        })->count();  //count today leads
        
        $yearLeadsCount = DB::table('leads')->whereYear('created_at', Carbon::now()->year)
        ->when(!$isAdmin, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
        })->count(); // count current year lead
       
        $convertLeadsCount = DB::table('leads')->where('status_id','2')->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->when(!$isAdmin, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
        })->count(); // Count month Converted Lead

        $monthLeadsCount = DB::table('leads')->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->when(!$isAdmin, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
        })->count(); // Count month Lead

        $lastMonthLead = DB::table('leads')->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->subMonth()->month)
        ->when(!$isAdmin, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
        })->count(); // Last Month Lead Count

        //End Stats Functions

        // User List 
        // $users = User::where('id', '!=', '1')
        //     ->withCount([
        //     'leads as convertedLead' => function ($query) {
        //         $query->where('status_id', 2);
        //     }
        // ])->get();

        $users = User::where('id', '!=', '1')
        ->withCount([
            'leads as current_month_leads_count' => function ($query) {
                $query->whereMonth('created_at', now()->month)
                      ->whereYear('created_at', now()->year);
            },
            'convertedLeads as current_month_converted_leads_count' => function ($query) {
                $query->whereMonth('created_at', now()->month)
                      ->whereYear('created_at', now()->year);
            }
        ])->get();

        





        // Recents Leads    
        if(Auth::user()->hasRole('admin')){
           $leads= Lead::orderBy('id', 'desc')->paginate(10);
        }else{
           $leads= Lead::where('user_id', $userId)->orderBy('id', 'desc')->paginate(10);
        }

        $data = [
            "todayLead"       => $todayLeadsCount,
            "monthLead"       => $monthLeadsCount,
            "yearleadCount"   => $yearLeadsCount, 
            "convertedLead"   => $convertLeadsCount,
            "leadConvertRate" => conversion_rate($convertLeadsCount, $monthLeadsCount),
            "LeadMonthGrowth" => growth_calculation($monthLeadsCount,$lastMonthLead),
            "userList"        => $users,
            "recentLeads"     => $leads    
            // "leadstatus"      => json_encode($leadData),
            // "statusValue"     => json_encode($statusValue),
            // "statusColor"     => json_encode($statusColor),
            // "leadStatusCount" => $leadStatusCount,
            // "recentlyAddLeads" => $recentlyAddLeads,
            // "statusData"       => implode(", ",$statusData),
            // "lastMonthStatusData" => implode(", ",$lastMonthStatusData),
            // "statusNameBar"    => implode(",",$statusNameBar),
            // "freshAccount"     => $freshAccount 
        ]; 
       
        return view('dashboard',compact('data'));   
    }
}
