<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;

class CovidController extends Controller
{
    //* menampilkan semua data
    public function index() {
        // buat variable untuk menampung method all() eloquent
        $patients = Patients::all();
        // buat variable $row untuk menampung semua isi yang ada di dalam Table Patients, menggunakan fungsi count()
        $row = $patients->count();
        // pengkondisian
        if($row != null) {
            $data = [
                "message" => "Get All Resource",
                "data" => $patients
            ];
            return response()->json($data, 200);
        } else {
            $data =[
                "message" => "data Not found"
            ];
            return response()->json($data, 404);
        }
        
    }

    //* menambah data
    public function store(Request $request) {
        // buat variable yang menampung data request menggunakan fungsi validate
        $inputValidate = $request->validate([
        //  "key" => "rules"
            "name" => "required",
            "phone" => "numeric|max_digits:12|required",
            "address" =>"required|max:100",
            "status" => "required",
            "in_date_at" => "date|required",
            "out_date_at" => "date|required",
        ]);

        // fungsi create untuk menangkap data yang di inputkan
        $patients = Patients::create($inputValidate);
        $data = [
            "message" => " Resource is added successfully",
            "data" =>$patients
        ];
        
        return response()->json($data, 201);
    }

    //* detail sesuai id 
    public function show($id){
        $patients = Patients::find($id);

        if($patients) {
            $data = [
                "message" => "Get Detail Resource",
                "data" => $patients
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                "message"=> "data not found",

            ];
            return response()->json($data, 404);
        }

    }

    //* mengubah data
    public function update(Request $request, $id){
        $patients = Patients::find($id);

        if($patients) {
            $inputValidate = $request->validate([
                "name" => "required",
                "phone" => "numeric|max_digits:12|required",
                "address" =>"required|max:100",
                "status" => "required",
                "in_date_at" => "date|required",
                "out_date_at" => "date|required",
            ]);
            $patients->update($inputValidate);
            $data = [
                "message" => "Resource is update successfully",
                "data" => $patients
            ];
            return response()->json($data, 201);
        } else {
            $data = [
                "message" => "data Not found"
            ];

            return response()->json($data, 404);
        }

    }

    //* menghapus data 
    public function delete($id) {
        $patients = Patients::find($id);

        if($patients) {
            $patients->delete();
            $data = [
                "message" => "Resource is delete successfully",
                "data" => $patients
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                "message" => "Resource not found"
            ];
            return response()->json($data, 404);
        }
    }

    //* mencari sesuai nama
    public function search($nama) {
        $patients = Patients::where('name', $nama , '%' . $nama )->get();
        $total = $patients->count();
        if($total != null) {
           
            $data = [
                "message" => "Get searched resource",
                "data" => $patients,
            ];
            return response()->json($data, 200);

        } else {
            $data = [
                "message" => "Not found"
            ];
            return response()->json($data, 404);
        }

    }

    //* data yang positive
    public function positive() {

        $patients = Patients::where('status', 'positive')->get();
        $total = $patients->count();

        $data = [
            "message" => "Get positive resource",
            "total" => $total,
            "data" => $patients
        ];
        return response()->json($data, 200);
    }
    
    
    //* data yang sembuh 
    public function recovered() {
        $patients = Patients::where('status', 'recovered')->get();
        $total = $patients->count();

        $data = [
            "message" => "Get recovered resource",
            "total" => $total,
            "data" => $patients
        ];
        return response()->json($data, 200);
    }
    
    //* data yang meninggal
    public function dead() {
        $patients = Patients::where('status', 'dead')->get();
        $total = $patients->count();

        $data = [
            "message" => "Get dead resource",
            "total" => $total,
            "data" => $patients
        ];
        return response()->json($data, 200);
    }



}
