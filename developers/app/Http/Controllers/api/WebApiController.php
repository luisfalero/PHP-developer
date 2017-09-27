<?php

namespace App\Http\Controllers\api;

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
use App\Ubigeo;
use App\Hospital;
use App\Persona;
use App\PersonaWS;

class WebApiController extends Controller
{
    protected $user, $ubigeo, $hospital, $persona, $personaws;
    
    public function __construct()
    {
        $this->user = new User();
        $this->ubigeo = new Ubigeo();
        $this->hospital = new Hospital();
        $this->persona = new Persona();
        $this->personaws = new PersonaWS();
    }

    public function listar_departamento(Request $request)
    {
      $elementos = $this->ubigeo::distinct()->select('departamento')->orderBy("departamento")->get();
      $array = array('elementos'=>$elementos);
      $array = json_encode($array);
      return $_GET['jsoncallback'] . '(' . $array . ');';
    }

    public function listar_provincia(Request $request)
    {
      $departamento = $request['departamento'];
      $elementos = $this->ubigeo::distinct()->select('provincia')->where("departamento", $departamento)
      ->orderBy("provincia")->get();
      $array = array('elementos'=>$elementos);
      $array = json_encode($array);
      return $_GET['jsoncallback'] . '(' . $array . ');';
    }

    public function listar_distrito(Request $request)
    {
      $provincia = $request['provincia'];
      $elementos = $this->ubigeo::distinct()->select('codigo','distrito')->where("provincia", $provincia)
      ->orderBy("distrito")->get();
      $array = array('elementos'=>$elementos);
      $array = json_encode($array);
      return $_GET['jsoncallback'] . '(' . $array . ');';
    }

    public function listar_hospitales(Request $request)
    {
      $ubigeo = $request['ubigeo'];
      $elementos = $this->hospital::distinct()
      ->select('establecimiento', 'direccion','telefono','horario')
      ->where("ubigeo", $ubigeo)
      ->orderBy("establecimiento")->get();
      $array = array('elementos'=>$elementos);
      $array = json_encode($array);
      return $_GET['jsoncallback'] . '(' . $array . ');';
    }

    public function regla_2(Request $request)
    {
      $picadura_mosquito_zancudo = ($request['checkbox_1'] == 'A') ? 'picadura_mosquito_zancudo' : '';
      $fiebre = ($request['checkbox_2'] == 'A') ? 'fiebre' : '';
      $evaluacion = $request['evaluacion'];
      $elementos = array();
      $directorio = getcwd().'/regla/_facts_rules.pl';

      if(file_exists($directorio)){
        $cmd = "sospecha_dengue($evaluacion, $picadura_mosquito_zancudo).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "sospecha_dengue($evaluacion, $fiebre).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);
      }

      $array = array('elementos'=>$elementos);
      $array = json_encode($array);
      return $_GET['jsoncallback'] . '(' . $array . ');';
    }

    public function regla_3(Request $request)
    {
      $erupciones_cutaneas = ($request['checkbox_1'] == 'A') ? 'erupciones_cutaneas' : '';
      $dolor_cabeza = ($request['checkbox_2'] == 'A') ? 'dolor_cabeza' : '';
      $dolor_ojos = ($request['checkbox_3'] == 'A') ? 'dolor_ojos' : '';
      $dolor_musculos = ($request['checkbox_4'] == 'A') ? 'dolor_musculos' : '';
      $dolor_huesos = ($request['checkbox_5'] == 'A') ? 'dolor_huesos' : '';
      $vomitos_nauseas = ($request['checkbox_6'] == 'A') ? 'vomitos_nauseas' : '';
      $falta_apetito = ($request['checkbox_7'] == 'A') ? 'falta_apetito' : '';
      $sos_dengue = $request['evaluacion'];
      $elementos = array();
      $directorio = getcwd().'/regla/_facts_rules.pl';

      if(file_exists($directorio)){
        $cmd = "dengue_sin_sintomas($sos_dengue, $erupciones_cutaneas, $dolor_cabeza).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $erupciones_cutaneas, $dolor_ojos).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $erupciones_cutaneas, $dolor_musculos).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $erupciones_cutaneas, $dolor_huesos).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $erupciones_cutaneas, $vomitos_nauseas).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $erupciones_cutaneas, $falta_apetito).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_cabeza, $dolor_ojos).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_cabeza, $dolor_musculos).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_cabeza, $dolor_huesos).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_cabeza, $vomitos_nauseas).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_cabeza, $falta_apetito).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_ojos, $dolor_musculos).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_ojos, $dolor_huesos).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_ojos, $vomitos_nauseas).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_ojos, $falta_apetito).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_musculos, $dolor_huesos).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_musculos, $vomitos_nauseas).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_musculos, $falta_apetito).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_huesos, $vomitos_nauseas).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $dolor_huesos, $falta_apetito).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_sin_sintomas($sos_dengue, $vomitos_nauseas, $falta_apetito).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "sin_dengue($sos_dengue, $erupciones_cutaneas).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "sin_dengue($sos_dengue, $dolor_cabeza).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "sin_dengue($sos_dengue, $dolor_ojos).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "sin_dengue($sos_dengue, $dolor_musculos).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "sin_dengue($sos_dengue, $dolor_huesos).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "sin_dengue($sos_dengue, $vomitos_nauseas).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "sin_dengue($sos_dengue, $falta_apetito).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);        
      }

      $array = array('elementos'=>$elementos);
      $array = json_encode($array);
      return $_GET['jsoncallback'] . '(' . $array . ');';
    }

    public function regla_4(Request $request)
    {
      $dolor_abdominal_intenso = ($request['checkbox_1'] == 'A') ? 'dolor_abdominal_intenso' : '';
      $letargo_irritabilidad = ($request['checkbox_2'] == 'A') ? 'letargo_irritabilidad' : '';
      $sangrado_mucosa = ($request['checkbox_3'] == 'A') ? 'sangrado_mucosa' : '';
      $sensacion_desvanecimiento = ($request['checkbox_4'] == 'A') ? 'sensacion_desvanecimiento' : '';
      $dificultad_respiratoria = ($request['checkbox_5'] == 'A') ? 'dificultad_respiratoria' : '';
      $aceleracion_corazon = ($request['checkbox_6'] == 'A') ? 'aceleracion_corazon' : '';
      $dengue_ss = $request['evaluacion'];
      $elementos = array();
      $directorio = getcwd().'/regla/_facts_rules.pl';

      if(file_exists($directorio)){
        $cmd = "dengue_con_sintomas($dengue_ss, $dolor_abdominal_intenso).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_con_sintomas($dengue_ss, $letargo_irritabilidad).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_con_sintomas($dengue_ss, $sangrado_mucosa).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_con_sintomas($dengue_ss, $sensacion_desvanecimiento).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_con_sintomas($dengue_ss, $dificultad_respiratoria).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

        $cmd = "dengue_con_sintomas($dengue_ss, $aceleracion_corazon).";
        $output = `swipl -s $directorio -g "$cmd" -t halt.`;
        array_push($elementos, $output);

      }

      $array = array('elementos'=>$elementos);
      $array = json_encode($array);
      return $_GET['jsoncallback'] . '(' . $array . ');';
    }

    public function registrar_historia_clinica(Request $request)
    {
      $dni = $request['dni'];
      $celular = $request['celular'];
      $ubigeo = $request['ubigeo'];
      $estado = $request['estado'];
      $respuesta_1 = $request['respuesta_1'];
      $respuesta_2 = $request['respuesta_2'];
      $respuesta_3 = $request['respuesta_3'];
      $respuesta_4 = $request['respuesta_4'];
      $elementos = array();

      $elementos = $this->personaws::where('dni', $dni)->first();
      $elementos_persona = $this->persona::where('dni', $dni)->first();
      $elementos_ubigeo = $this->ubigeo::where('codigo', $ubigeo)->first();

      date_default_timezone_set('America/Lima');
      $fecha_actual = date('Y-m-d H:i:s');

      if(count($elementos_persona) == 0){
        $persona = array('dni' => $dni, 'nacionalidad' => 'Peruano',
        'nombre' => $elementos->nombre, 'celular' => $celular,
        'apellido_paterno' => $elementos->apellido_paterno, 'apellido_materno' =>  $elementos->apellido_materno,
        'fecha_nacimiento' => $elementos->fecha_nacimiento, 'sexo' => $elementos->sexo,
        'ubigeoid' => $elementos_ubigeo->id, 'lugar_nacimiento' => $elementos->ubigeoid,
        'created_at' => $fecha_actual,'updated_at' => $fecha_actual);    
        $personaid = DB::table('persona')->insertGetId($persona);
      }else{
        $personaid = $elementos_persona->id;
      }

      $estado = ($estado == 'dengue_ss') ? 'SOSPECHA DENGUE SIN SÍNTOMAS DE ALARMA' : 'SOSPECHA DENGUE CON SÍNTOMAS DE ALARMA';
      $persona = array('personaid' => $personaid, 'enfermedadid' => 1,
      'estado' => $estado, 'created_at' => $fecha_actual,'updated_at' => $fecha_actual,
      'respuesta_1' => $respuesta_1,'respuesta_2' => $respuesta_2, 
      'respuesta_3' => $respuesta_3,'respuesta_4' => $respuesta_4);    
      $casoid = DB::table('caso')->insertGetId($persona);

      $elementos = array('personaid' => $personaid);
      $array = array('elementos'=>$elementos);
      $array = json_encode($array);
      return $_GET['jsoncallback'] . '(' . $array . ');';
    }
}
