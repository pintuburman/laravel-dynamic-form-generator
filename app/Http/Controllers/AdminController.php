<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AllForm;
use App\Models\FormSchema;
use App\Models\FormSchemaMeta;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = AllForm::orderBy('id', 'desc')->paginate(10);
        return view('home',compact('forms'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fieldSet  =$request->input('fieldSet');

        $form = AllForm::create();
        $lastId = $form->id;

        foreach($fieldSet as $field){

            $data = [
                'label' => $field['label'],
                'name' =>$field['name'],
                'type' => $field['type'],
                'form_id'=>$lastId
            ];

            $result = FormSchema::create($data);

            if($field['type'] == "select"){
                foreach($field['options'] as $type_meta){
                    $data = [
                        'text' => $type_meta['optionText'],
                        'val' =>$type_meta['optionVal'],
                        'form_schema_id'=>$result->id,
                        'form_id'=>$lastId
                    ];
        
                    FormSchemaMeta::create($data);
                }
            }

        }

        return redirect()->back()->with('success', 'Form created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form = AllForm::find($id);
        return view('formEdit',compact('form'));
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

         $FormSchema = FormSchema::where('form_id',$id);    
         $FormSchema->delete();

         $FormSchemaMeta = FormSchemaMeta::where('form_id',$id);    
         $FormSchemaMeta->delete();

        $fieldSet  =$request->input('fieldSet');

        //dd($request->all());

        foreach($fieldSet as $field){

            $data = [
                'label' => $field['label'],
                'name' =>$field['name'],
                'type' => $field['type'],
                'form_id'=>$id
            ];

            $result = FormSchema::create($data);

            if($field['type'] == "select"){
                foreach($field['options'] as $type_meta){
                    $data = [
                        'text' => $type_meta['optionText'],
                        'val' =>$type_meta['optionVal'],
                        'form_schema_id'=>$result->id,
                        'form_id'=>$id
                    ];
        
                    FormSchemaMeta::create($data);
                }
            }

        }

        

        return redirect()->back()->with('success', 'Form Details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form = AllForm::find($id);    
        $form->delete();

         $FormSchema = FormSchema::where('form_id',$id);    
         $FormSchema->delete();

         $FormSchemaMeta = FormSchemaMeta::where('form_id',$id);    
         $FormSchemaMeta->delete();

        return redirect()->back()->with('success', 'Form deleted successfully');
    }
}