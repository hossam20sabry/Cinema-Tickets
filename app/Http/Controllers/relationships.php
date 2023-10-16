<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Adddress;
use App\Models\Hospital;
use App\Models\Doctor;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;
use PDO;

use function Laravel\Prompts\select;

class relationships extends Controller
{
    public function has_one(){
        // $user = User::find(1);
        // $user->adddress;

        $user = User::with(['adddress' => function($city){
            $city->select('city','street', 'user_id');
        }])->find(1);
        return $user->adddress->city;
        return response()->json($user);
    }
    public function has_one_reerse(){
        $address = Adddress::with(['user' => function($i){
            $i->select('name', 'phone','id');
        }])->find(1);
        $address->makeVisible(['user_id']);
        // $address->makeHidden(['street']);
        $address->makeHidden(['street']);
        // return $address->user;
        return $address;
    }
    public function wherHas(){
        return $user = User::whereDoesntHave('adddress')->get();
    }




    //one hospital  to many doctors
    public function one_to_many(){
        $Hospital = Hospital::with('doctors')->find(1); // Hospital::where('id',1)->first() // Hospital::first() just the first row
        $docs = $Hospital->doctors;
        // foreach($docs as $doc){
        //     echo $doc->name .'<br>';
        // }

        $doctors = Doctor::find(2);

        return $doctors->hospital;
    }

    public function show_hospitals(){
        $hospitals = Hospital::all();
        return view('home.test', compact('hospitals'));
    }
    public function show_doctors($id){
        $Hospital = Hospital::with('doctors')->find($id);
        $doctors = $Hospital->doctors;
        return view('home.test2', compact('doctors'));
    }
    // public function show_doctors($id) {
    //     $doctors = DB::table('hospitals')
    //                 ->join('doctors', 'hospitals.id', '=', 'doctors.hospital_id')
    //                 ->select('doctors.*')
    //                 ->where('hospitals.id', $id)
    //                 ->get();
    
    //     return view('home.test2', compact('doctors'));
    // }

    public function show_whrereHas_hospitals(){
        $hospitals = Hospital::with('doctors')->whereHas('doctors' , function($q){
            $q->where('name','mohamed');
        })->get();
        return $hospitals;
    }

    public function delete_hospital($id){
        $hospitals = Hospital::find($id);
        // if(!$hospitals){
        //     return abort('404');
        // }
        // else{
        //     $hospitals->doctors()->delete();
        // }
        $hospitals->delete();
        return redirect()->back();
    }
    
    public function doctor_service(){
        $doctor = Doctor::with('services')->find(1);
        // $doctor = Doctor::find(2);
        $doctor->makeHidden(['created_at','updated_at']);
        $doctor->services->makeHidden(['created_at','updated_at']);
        return $doctor;
    }

    public function show_services($id){
        $doctor = Doctor::find($id);
        $services = $doctor->services;
        $all_doctors = Doctor::select('id','name')->get();
        $all_services = Services::select('id','name')->get();
        return view('home.test3', compact('services', 'doctor','all_doctors', 'all_services'));
    }


    public function add_service_to_doctoer(Request $request){
        $doctor = Doctor::find($request->doctor_id);
        $doctor->services()->syncWithoutDetaching($request->servicesIds); //لا تسمح بالتكرار
        return redirect()->back();
    }
    
}
