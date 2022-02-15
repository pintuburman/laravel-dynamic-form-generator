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

        

        /*foreach($forms as $form){
            echo '<form>';
            foreach($form->schema as $schema){
                echo '<div class="form-group">';
                echo '<label class="form-label">'.$schema->label.'</label>';

                if($schema->type == 'text'){
                    echo '<input class="form-control" type="text" name="'.$schema->name.'">';
                }else if($schema->type == 'number'){
                    echo '<input class="form-control" type="number" name="'.$schema->name.'">';
                }else if($schema->type == 'select'){
                    echo '<select class="form-control" name="'.$schema->name.'">';
                    foreach($schema->SchemaMeta as $meta){
                        echo '<option value="'.$meta->val.'">'.$meta->text.'</option>';
                    }
                    echo '</select>';
                }
                echo '</div>';
            }
            echo '<button class="btn btn-primary" type="submit">Submit</button>';
            echo '</form>';
        }

    
        die();*/

        return view('home', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());

        $fieldSet  =$request->input('fieldSet');

        $form = AllForm::create();
        $lastId = $form->id;

        // echo $lastId;
        // die();

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


        // $request->validate([
        //     'name' => 'required|min:3',
        //     'phone' => 'numeric|required|min:10',
        //     'gender' => 'required',
        // ]);

        // $data = [
        //     'name' => $request->input('name'),
        //     'phone' => $request->input('phone'),
        //     'gender' => ($request->input('gender') != 'Other') ? $request->input('gender') : $request->input('otherGender'),
        //     'gender_other_flag' => ($request->input('gender') == 'Other') ? 1 : 0
        // ];

        // User::create($data);

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