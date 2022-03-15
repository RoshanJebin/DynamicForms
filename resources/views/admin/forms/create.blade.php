@extends('admin.includes.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('forms.index')}}" class="btn btn-sm btn-secoondary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
                    Create Form
                </div>

                <div class=" card-body">
                    @include('admin.includes.messages')
                    <form action="{{route('forms.store')}}" method="POST" enctype="multipart/form-data" class=" mb-4 blue_label">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="control-label">Form Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
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
                                </tbody>
                                <input type="hidden" id="SlRowField" value="0">
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
@endsection