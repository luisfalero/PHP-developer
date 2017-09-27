<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use SoapBox\Formatter\Formatter;
use DB; 
use Session;
use Validator;
use Input;

class EmployeesController extends Controller
{
    private $json;
	
	function __construct()
	{
        $path = getcwd()."/json/employees.json";
        $this->json = json_decode(file_get_contents($path), true);
    }
    
    public function list()
    {   
        $count = count($this->json);
        $elementos = array();
        foreach ($this->json as $element => $data) {
            $i = (int) $element;
            $elementos[$i]["id"] = $data["id"];
            $elementos[$i]["name"] = $data["name"];
            $elementos[$i]["name"] = $data["name"];
            $elementos[$i]["email"] =  $data["email"];
            $elementos[$i]["position"] = $data["position"];
            $elementos[$i]["salary"] = $data["salary"];
        }
        $data = array('elementos' => $elementos, 'cantidad' => $count);
        return view('admin.employees.listar', $data);
    }

    public function show($id){
        $index = array_search($id, array_column($this->json, 'id'));
        if($index != ''){
            $elementos = $this->json[$index];
            $data = array('elementos' => $elementos);
            return view('admin.employees.registrar', $data);
        }else{
            return view('errors.404');
        }
    }

    public function showEmail(Request $request){
        $index = array_search($request["email"], array_column($this->json, 'email'));
        if($index != ''){
            $elementos = $this->json[$index];
            $data = array('elementos' => $elementos);
            return view('admin.employees.registrar', $data);
        }else{
            return view('errors.404');
        }
    }

    public function salary(){
        return view('admin.employees.salario');
    }

    public function showSalary(Request $request){
		$count = count($this->json);
		$array = Array();
		$monto_minimo = str_replace(',', '', $request["monto_minimo"]);
		$monto_maximo = str_replace(',', '', $request["monto_maximo"]);
		for ($i=0; $i < $count; $i++) {
			$salary = substr($this->json[$i]['salary'], 1);
			$salary = str_replace(',', '', $salary);
			if ($salary >= $monto_minimo && $salary <= $monto_maximo) {
				array_push($array, array( 'item' => $this->json[$i]));
			}
        }
   
        $formatter = Formatter::make($array, Formatter::ARR);
        $xml   = $formatter->toXml();
        return $xml;
    }
}
