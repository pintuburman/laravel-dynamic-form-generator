@extends('layouts.app')

@section('styles')
<style>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0;
}

form section{
    padding-bottom:50px;
    border-bottom:1px dashed #ccc;
}
</style>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Create Dynamic form</h4>
                </div>

                <div class="card-body">

                    @if(\Session::has('success'))
                    <div class="mb-3 alert alert-success alert-dismissible show" role="alert">
                        {!! \Session::get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (count($errors) > 0)
                    <div class="mb-3 alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('forms.store') }}" method="POST">
                        @csrf

                        <section data-fieldSet="0">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Label Name</label>
                                <input required name="fieldSet[0][label]" type="text" class="form-control"
                                    id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Label Name">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Input Name</label>
                                <input required name="fieldSet[0][name]" type="text" class="form-control"
                                    id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Input Name">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Input Type</label>
                                <select required name="fieldSet[0][type]" class="form-control InputType">
                                    <option value="">Please Select...</option>
                                    <option value="text">Text</option>
                                    <option value="number">Number</option>
                                    <option value="select">Select</option>
                                </select>
                            </div>

                            <div class="form-group addOption mt-3" style="display:none">
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <label class="form-label" for="exampleInputEmail1">Option Text</label>
                                            <input name="fieldSet[0][options][0][optionText]" type="text"
                                                class="form-control optionText" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Enter Option Text">
                                        </td>
                                        <td>
                                            <label class="form-label" for="exampleInputEmail1">Option Value</label>
                                            <input name="fieldSet[0][options][0][optionVal]" type="text"
                                                class="form-control optionVal" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Enter Option Value">
                                        </td>
                                        <td style="width:100px">

                                        </td>

                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info mt-4 addOption">
                                                Add New Option
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </section>

                        <div class="form-group">
                            <button type="button" class="btn btn-sm btn-dark mt-4 addMore">
                            <i class="bi bi-plus"></i> Add More Fields
                            </button>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-4">Generate Form</button>
                        </div>

                    </form>

                </div>
            </div>


            <h4 class="mt-5">All Forms</h4>


            <div id="table_data" class="mt-5">
                        <div class="table-responsive">
                            <table class="table mb-5">
                                <thead>
                                    <tr class="table-success">
                                        <th>Name</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($forms as $data)
                                    <tr>
                                        <td>Form #{{ $data->id }}</td>
                                        <td style="max-width: 200px;">{{ $data->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('forms.show', $data->id) }}" class="btn-space btn btn-info btn-sm updateurl"><i class="fa fa-globe"
                                                    aria-hidden="true"></i> Edit</a>

                                            <form style="display: inline-block;"
                                                action="{{ route('forms.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button title="Delete Page" class='btn-space btn btn-sm btn-danger'>
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">
                                            <p class="text-center">
                                                No data found.
                                            </p>
                                        </td>
                                    </tr>
                                    @endforelse



                                </tbody>
                            </table>
                        </div>
                        <div>
                            Showing
                            @if($forms->total() > 0)
                            {{ $forms->firstItem() }} to {{ $forms->lastItem() }}
                            of total
                            @endif
                            {{$forms->total()}} entries
                        </div>
                        <div class="d-flex justify-content-center">
                            {!! $forms->links("pagination::bootstrap-4") !!}
                        </div>
                    </div>




        </div>
    </div>
</div>
@endsection

@section('footer_script')
<?php 

$selectOption = '<tr>
<td>
    <label class="form-label" for="exampleInputEmail1">Option Text</label>
    <input required name="optionText" type="text" class="form-control optionText" aria-describedby="emailHelp"
        placeholder="Enter Option Text">
</td>
<td>
    <label class="form-label" for="exampleInputEmail1">Option Value</label>
    <input required name="optionVal" type="text" class="form-control optionVal" aria-describedby="emailHelp"
        placeholder="Enter Option Value">
</td>
<td>
<button type="button" class="btn btn-warning mt-4 DelteOption">
    Delete
</button>
</td>

</tr>';

$formBuilder = '<section data-fieldSet="0" class="mt-4">
<h4>
<table width="100%">
    <tr>
<td>New Field</td>
<td align="right"><button type="button" class="btn btn-danger DeleteField">
    <i class="bi bi-trash3"></i>
</button></td>
</tr>
</table>
</h4>
<div class="form-group">
    <label class="form-label" for="exampleInputEmail1">Label Name</label>
    <input required name="label" type="text" class="form-control label" aria-describedby="emailHelp" placeholder="Enter Label Name">
</div>

<div class="form-group">
    <label class="form-label" for="exampleInputEmail1">Input Name</label>
    <input required name="name" type="text" class="form-control name" aria-describedby="emailHelp" placeholder="Enter Input Name">
</div>

<div class="form-group">
    <label class="form-label" for="exampleInputEmail1">Input Type</label>
    <select required name="type" class="form-control InputType">
        <option value="">Please Select...</option>
        <option value="text">Text</option>
        <option value="number">Number</option>
        <option value="select">Select</option>
    </select>
</div>

<div class="form-group addOption mt-3" style="display:none">
<table width="100%">
    <tr>
        <td>
            <label class="form-label" for="exampleInputEmail1">Option Text</label>
            <input name="fieldSet[0][options][0][optionText]" type="text" class="form-control optionText"
                id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter Option Text">
        </td>
        <td>
            <label class="form-label" for="exampleInputEmail1">Option Value</label>
            <input name="fieldSet[0][options][0][optionVal]" type="text" class="form-control optionVal"
                id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter Option Value">
        </td>
        <td style="width:100px">
        
        </td>

    </tr>
</table>
<table>
    <tr>
        <td>
            <button type="button" class="btn btn-sm btn-info mt-4 addOption">
                Add New Option
            </button>
        </td>
    </tr>
</table>
</div>
</section>';
?>


<script>
var x = 1;
var pos = 1;

var init = function() {
    $(".InputType").on('change', function() {
        var selval = $(this).val();
        console.log(selval);
        if (selval == 'select') {
            $(this).closest('.form-group').siblings(".addOption").slideDown();
            $(this).closest('.form-group').siblings(".addOption").find(".optionText").attr('required',
                true);
            $(this).closest('.form-group').siblings(".addOption").find(".optionVal").attr('required', true);
        } else {
            $(this).closest('.form-group').siblings(".addOption").slideUp();
            $(this).closest('.form-group').siblings(".addOption").find(".optionText").removeAttr(
                'required');
            $(this).closest('.form-group').siblings(".addOption").find(".optionVal").removeAttr(
                'required');
        }
    });


};

init();


$(".addMore").on('click', function(e) {

    e.stopPropagation();

    var options = '{!! preg_replace( "/\r|\n/", "", $formBuilder) !!}';
    options = $.parseHTML(options);

    $(options).find('.label').attr('name', "fieldSet[" + x + "][label]");
    $(options).find('.name').attr('name', "fieldSet[" + x + "][name]");
    $(options).find('.InputType').attr('name', "fieldSet[" + x + "][type]");
    $(options).attr('data-fieldSet', x);


    $(options).find('.optionText').attr('name', "fieldSet[" + x + "][options][" + pos + "][optionText]");
    $(options).find('.optionVal').attr('name', "fieldSet[" + x + "][options][" + pos + "][optionVal]");

    $(this).before(options);

    x++;

    init();
});


var addrow = function(fieldSet, sthis) {
    var options = '{!! preg_replace( "/\r|\n/", "", $selectOption) !!}';
    options = $.parseHTML(options);
    $(options).find('.optionText').attr('name', "fieldSet[" + fieldSet + "][options][" + pos + "][optionText]");
    $(options).find('.optionVal').attr('name', "fieldSet[" + fieldSet + "][options][" + pos + "][optionVal]");
    sthis.closest('table').siblings('table').append(options);
    pos++;
};

$(document).on('click', ".addOption", function(e) {
    e.stopPropagation();
    var fieldSet = $(this).closest('section').attr('data-fieldSet');
    addrow(fieldSet, $(this));
});

$(document).on('click', ".DeleteField", function(e) {
    e.stopPropagation();
    $(this).closest('section').remove();
    x--;
});

$(document).on('click','.DelteOption',function(e){
    e.stopPropagation();
    $(this).closest('tr').remove();
    pos--;
    console.log(pos);
});
</script>
@stop