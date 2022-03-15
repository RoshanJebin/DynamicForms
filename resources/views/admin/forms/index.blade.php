@extends('admin.includes.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 " style="text-align: left;">
                            <h3 class="box-title m-b-0">Forms</h3>
                        </div>
                        <div class="col-lg-6 col-md-6" style="text-align: right;">
                            <a href="{{ route('forms.create') }}" class="btn btn-primary btn-with-icon-text">
                                <i class="icon-plus"></i> Add new
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($forms->isNotEmpty())
                                @foreach($forms as $key=>$data)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$data->title}}</td>
                                    <td>
                                        @if($data->status==0)
                                        <a href="{{ route('forms.activate',$data->id) }}" class="text-secondary " title="Click to activate"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
                                        @else
                                        <a href="{{ route('forms.deactivate',$data->id) }}" class="text-success " title="Click to deactivate"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="float:left;">
                                            <a href="{{ route('forms.edit',$data->id) }}" class="btn btn-secondary btn-sm  " title="Edit"><i class="fa fa-pen"></i> </a>
                                            </a>
                                        </div>
                                        <div style="float:left;padding-left: 2px;">
                                            <button type="button" class="btn btn-danger btn-sm" title="Click to Delete" onclick="deleteForm('{{ $data->id }}')"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" style="text-align: center;">No Data found in Table !!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
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