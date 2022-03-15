@extends('admin.includes.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('forms.index')}}" class="btn btn-sm btn-secoondary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
                    Edit Form
                </div>

                <div class=" card-body">
                    @include('admin.includes.messages')
                    <form action="{{route('forms.update',$form->id)}}" method="POST" enctype="multipart/form-data" class=" mb-4 blue_label">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="control-label">Form Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{$form->title}}" required>
                                    </div>
                                </div>
                            </div><br>
                            <table class="table table-responsive table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20%">Label</th>
                                        <th width="20%">HTML Field</th>
                                        <th width="55%">Custom Values <small>(seperate options by a semicolon (;))</small></th>
                                        <th width="5%">
                                            <button type="button" class="btn btn-secondary btn-sm" onclick="return addField()">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            <input type="hidden" id="addFieldVar" value="0">
                                        </th>
                                    </tr>
                                </thead>
                                <tfoot></tfoot>
                                <tbody id="appendField">
                                    @if($form->fields)
                                    @foreach($form->fields as $key=>$section)
                                    <tr id="rowField{{$key+1000}}">
                                        <td><input type="text" class="form-control" name="label[]" value="{{$section->label }}" placeholder="Label" required></td>
                                        <td>
                                            <select name="html_field[]" class="form-control" onchange="check_html_field('{{$section->id}}')" id="html_field{{$section->id}}">
                                                <option value="text" {{$section->html_field=="text"?'selected':''}}>Text</option>
                                                <option value="number" {{$section->html_field=="number"?'selected':''}}>Number</option>
                                                <option value="select" {{$section->html_field=="select"?'selected':''}}>Select</option>
                                            </select>
                                        </td>
                                        <td><textarea rows="1" class="form-control" id="custom_value{{$section->id}}" name="custom_value[]" style="display: {{$section->html_field=="select"?'':'none'}};">{{ $section->custom_value }}</textarea></td>
                                        <td><button type="button" class="btn btn-danger btn-sm" title="Click to Delete" onclick="deleteField('{{ $section->id }}')"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                    <input type="hidden" name="field_id[]" value="{{ $section->id }}">
                                    @endforeach
                                    @endif
                                </tbody>
                                <input type="hidden" id="SlRowField" value="{{$form->fields? count($form->fields) :0}}">
                            </table>
                        </div>
                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-success"> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="confirmationPopup" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deletion Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center text-danger">
                <i class="fa fa-trash fa-3x"></i>
            </div>
            <div class="modal-footer">
                <a id="link" class="btn btn-danger" href="" style="color: white;">Delete</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection