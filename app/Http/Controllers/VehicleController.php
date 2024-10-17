<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicle;
use App\Models\User;


class VehicleController extends Controller
{

    public function generateCategory($power){
        if($power<200){
            return 'D';
        }
        if($power<400){
            return 'C';
        }
        if($power<600){
            return 'B';
        }
        return 'A';


    }

    public function store(Request $request){


        $user = Auth::user();
        if($user == NULL || $user->is_administrator){
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }

        $request->validate([
            'model' => ['required', 'string', 'max:30'],
            'brand' => ['required','max:30'],
            'year' => ['required', 'integer', 'min:1886'],
            'power' => ['required', 'integer', 'min:1'],
        ]);


        $vehicle = new Vehicle;

        $vehicle->model = $request->model;
        $vehicle->brand = $request->brand;
        $vehicle->year = $request->year;
        $vehicle->power = $request->power;
        $vehicle->user_id = $user->id;
        $vehicle ->category = $this->generateCategory($request->power);

        $vehicle->save();
        return redirect('/dashboard/user')->with('msg', "Veículo {$vehicle->model} adicionado com sucesso");

    }



    public function show($id){

        $vehicle = Vehicle::findOrFail($id);
        $user = User::where('id', $vehicle->user_id)->first()->toArray();
        return $user;
        return $vehicle;
    }


    public function edit($id){

        $vehicle = Vehicle::findOrFail($id);

        return view('vehicle.edit',['vehicle' => $vehicle]);
    }

    public function create(){

        return view('vehicle.create');
    }



    public function update(Request $request){

        $user = Auth::user();
        if($user == NULL || $user->is_administrator){
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        $request->validate([
            'model' => ['required', 'string', 'max:30'],
            'brand' => ['required','max:30'],
            'year' => ['required', 'integer', 'min:1886'],
            'power' => ['required', 'integer', 'min:1'],
        ]);


        $vehicle = Vehicle::findOrFail($request->id);
        if($vehicle->user_id != $user->id){
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        $vehicle ->category = $this->generateCategory($request->power);
        $vehicle->update($request->all());

        return redirect('/dashboard/user')->with('msg','Veículo editado com sucesso');;
    }

    public function destroy($id){

        $user = Auth::user();
        if($user == NULL || $user->is_administrator){
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        $vehicle = Vehicle::findOrFail($id);
        if($vehicle->user_id != $user->id){
            return redirect('/')->with('msg', 'Você não tem permissão para acessar essa página');
        }
        $vehicle->delete();

        return redirect('/dashboard/user')->with('msg','Veículo retirado com sucesso');

    }
}
