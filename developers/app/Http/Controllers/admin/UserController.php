<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use DB; 
use Session;
use Validator;
use Input;

use App\User;

class UserController extends Controller
{
    protected $user;
    
    public function __construct()
    {
        $this->user = new User();
    }

    public function list()
    {        
        if(isset(Auth::user()->id)){
            return view('admin.public.inicio');
        }else{
            return view('admin.login');
        }
    }

    public function login(Request $request)
    {   
        $this->validate($request, [
            'correo' => 'required|email|max:255|exists:users',
            'clave' => 'required|max:255'
        ]);

        $correo = $request->correo;
        $clave = $request->clave;

        if(Auth::attempt(array('correo'=>$correo, 'password'=>$clave))){
            return redirect('admin');
        }else{
            return redirect()->back()
            ->withInput()
            ->withErrors([
                'correo' => 'Estas credenciales no coinciden con nuestros registros.',
            ]);
        }
    }

    public function add()
    {
        return view('admin.register');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */   
    
    public function index()
    {
        if(!isset(Auth::user()->id)){
            return redirect('/');
        }

        if(Auth::user()->cargo == 'A'){
            $elementos = $this->user
                        ->select('users.id','users.nombres','users.apellidos','users.correo', 'area.nombre as area',
                        DB::raw("case when users.cargo = 'J' then 'Jefe de Área' else 'Trabajador' end as cargo")) 
                        ->join('area','area.id','=','users.area_id')
                        ->where('cargo', '<>', 'A')
                        ->orderBy('id')
                        ->get();
            $data = array('elementos' => $elementos, 'cantidad' => count($elementos));
            return view('admin.usuario.listar', $data);
        }else{
            return view('errors.404');
        }
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!isset(Auth::user()->id)){
            return redirect('/');
        }

        if(Auth::user()->cargo == 'A'){
            $elementosArea = $this->area::orderBy('nombre')->pluck('nombre', 'id');
            $data = array('elementosArea' => $elementosArea);
            return view('admin.usuario.registrar', $data);
        }else{
            return view('errors.404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        if(!isset(Auth::user()->id)){
            return redirect('/');
        }

        $this->validate($request, [
            'dni' => 'required|digits:8|integer|unique:users',
            'nombres' => 'required|max:100|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|max:100|regex:/^[\pL\s\-]+$/u',
            'correo' => 'required|email|max:100|unique:users',
            'clave' => 'required|max:100'
        ]);

        if(isset($request['cb_jefe'])){
            $cantidad_jefe = $this->user::
            where('cargo', 'J')
            ->where('area_id',  $request['area_id'])
            ->count();

            if($cantidad_jefe > 0){
                return redirect()->back()
                    ->withInput()
                    ->withErrors([
                        'area' => 'Existe un jefe de área ya registrado.',
                ]);
            }
        }

        $this->user->dni = $request['dni'];
        $this->user->nombres = $request['nombres'];
        $this->user->apellidos = $request['apellidos'];
        $this->user->correo = $request['correo'];
        $this->user->password = bcrypt($request['clave']);
        $this->user->cargo = (isset($request['cb_jefe'])) ? "J" : "T";
        $this->user->area_id = $request['area_id'];
        if(!isset($request['cb_jefe'])) $this->user->usuario_id = $request['usuario_id'];
        $this->user->save();
        
        Session::flash('flashMessage',__('!Se ha guardado con éxito!')); 
        Session::flash('flashType',config('global.success')); 
        
        if(Input::get('guardar_listar')) {
            return redirect('admin/usuarios'); 
        } elseif(Input::get('guardar')) {
            return redirect('admin/usuario/nuevo'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!isset(Auth::user()->id)){
            return redirect('/');
        }

        if(Auth::user()->cargo == 'A'){
            $elementos = $this->user::
                select('id','dni','nombres', 'apellidos', 'correo','password', 'estado', 'cargo', 'usuario_id', 'area_id')
                ->where('id', $id)
                ->first();
            $elementosArea = $this->area::orderBy('nombre')->pluck('nombre', 'id');
            $data = array('elementos' => $elementos, 'elementosArea' => $elementosArea, 'cantidad' => count($elementos));
            return view('admin.usuario.registrar', $data);
        }else{
            return view('errors.404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!isset(Auth::user()->id)){
            return redirect('/');
        }

        $this->validate($request, [
            'dni' => 'required|digits:8|integer|unique:users,dni,'.$id,
            'nombres' => 'required|max:100|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|max:100|regex:/^[\pL\s\-]+$/u',
            'correo' => 'required|email|max:100|unique:users,correo,'.$id,
            'clave' => 'max:100'
        ]);   

        if(isset($request['cb_jefe'])){
            $cantidad_jefe = $this->user::
            where('cargo', 'J')
            ->where('area_id',  $request['area_id'])
            ->where('id', '<>',  $id)
            ->count();

            if($cantidad_jefe > 0){
                return redirect()->back()
                    ->withInput()
                    ->withErrors([
                        'area' => 'Existe un jefe de área ya registrado.',
                ]);
            }
        }     

        $objUsuario = $this->user::find($id);

        $objUsuario->dni = $request['dni'];
        $objUsuario->nombres = $request['nombres'];
        $objUsuario->apellidos = $request['apellidos'];
        $objUsuario->correo = $request['correo'];

        if($request['clave'] != "") $objUsuario->password = bcrypt($request['clave']);

        $objUsuario->cargo = (isset($request['cb_jefe'])) ? "J" : "T";
        $objUsuario->area_id = $request['area_id'];
        if(!isset($request['cb_jefe'])) $objUsuario->usuario_id = $request['usuario_id'];
        $objUsuario->save();

        Session::flash('flashMessage',__('!Se ha modificado con éxito!')); 
        Session::flash('flashType',config('global.success')); 
        return redirect('admin/usuarios'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!isset(Auth::user()->id)){
            return redirect('/');
        }

        try {
            $objUsuario = $this->user::find($id);
            $objUsuario->delete();

            Session::flash('flashMessage',__('!Se ha eliminado con éxito!')); 
            Session::flash('flashType',config('global.success')); 
            return redirect('admin/usuarios'); 

        } catch (QueryException $e) {
            Session::flash('flashMessage',__('!Error al eliminar el registro!')); 
            Session::flash('flashType',config('global.danger')); 
            return redirect('admin/usuarios');           
        }
    }

    public function signOff()
    {   
        Session::flush();
        return redirect('admin');
    }

    public function boss(Request $request){

        if(!isset(Auth::user()->id)){
            return redirect('/');
        }

        $area_id = $request['area_id'];
        $elementos = $this->user:: 
                    select('id','nombres','apellidos')
                    ->where('area_id', $area_id)
                    ->where('cargo', 'J')
                    ->first();     
        $retorno = false;

        if($request->ajax()){
            $retorno = true;

            if(count($elementos) > 0){
                return response()->json([
                    'mensaje'=>  $retorno,
                    'usuario_id'=>  $elementos->id,
                    'usuario'=>  $elementos->nombres.' '.$elementos->apellidos,
                    'cantidad' => count($elementos)
                ]);
            }else{
                 return response()->json([
                    'mensaje'=>  $retorno,
                    'cantidad' => count($elementos)
                ]);
            }
        }else{
            return response()->json([
                'mensaje'=>  $retorno
            ]);
        }
    }
}
