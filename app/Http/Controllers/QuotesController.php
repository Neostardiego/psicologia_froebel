<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuotesRequest;
use App\Http\Resources\QuotesCollection;
use App\Http\Resources\QuotesResource;
use App\Models\Quotes;
use App\Models\Students;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuotesController extends Controller
{
    public function index()
    {
        return view('quotes.index');
        
    }
    public function columns()
    {
        return [
            'name' => 'Nombres',
            'date' => 'Fecha',
            'user' => 'Responsable'
        ];
    }
    public function filter(Request $request){
       // dd($request->all());
        $students=Students::select(DB::raw('CONCAT(name, " " ,surnames) AS student'),'id')->where('grade','=',$request->grade)->get();
        return compact('students');
    }
  
    public function tables(){
        $user_id=auth()->user()->id;
        $responsable=auth()->user()->name;
       // $students=Students::select(DB::raw('CONCAT(name, surnames) AS student'),'id')->get();
        return compact('user_id','responsable');
    }
    public function record($id)//Selecccionar un Registro
    {
        $record = new QuotesResource(Quotes::findOrFail($id));
        return $record;
    }
    public function exportar(Request $request){
        $records=Quotes::all();
        return PDF::loadView('export.index',['records'=>$records])
        ->setPaper('A4')->stream();
        //$pdf = PDF::loadView('export.index', $data);
        //return $pdf->stream('invoice.pdf');
    }
    public function records(Request $request)
    {
        if($request->column=='name'){
            $records = Quotes::where('user_id',auth()->user()->id)->whereHas('students', function($query) use($request){
                $query->where('name', 'like', "%{$request->value}%");
           });
        }else if($request->column=='user'){
            $records = Quotes::where('user_id',auth()->user()->id)->whereHas('user', function($query) use($request){
                $query->where('name', 'like', "%{$request->value}%");
           });
        }else{
            $records = Quotes::where('user_id',auth()->user()->id)->where($request->column, 'like', "%{$request->value}%")->orderBy($request->column,'asc');            
        }
        return new QuotesCollection($records->paginate(config('tenant.items_per_page')));
      
    }
    public function store(QuotesRequest $request){
    
        $id = $request->input('id');
        $quotes = Quotes::firstOrNew(['id' => $id]);
        $quotes->fill($request->all());
        $quotes->date=Carbon::parse($request->input('date'))->format('Y-m-d');
        $quotes->save();
        return [
            'success' => true,
            'message' => ($id)?'Cita modificado con éxito':'Cita registrado con éxito',
            'id' => $quotes->id
        ];   
    }
    public function delete($id)//Eliminar
    {
        $box = Quotes::findOrFail($id);
        $box->delete();
        return [
            'success' => true,
            'message' => 'Eliminado con éxito'
        ];
    }
}
