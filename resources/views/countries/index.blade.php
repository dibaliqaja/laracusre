@extends('layouts.main')

@section('title_page', 'Countries')
@section('content')
    <div class="col-xl-12 col-lg-12">
        @if (Session::has('alert'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session('alert') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Country list</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <a href="{{ route('countries.create') }}" class="btn btn-primary">Add new country</a><br><br>
                    </div>
                    <div class="col-md-4">
                        <form action="#" class="flex-sm">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Search" value="{{ Request::get('keyword') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary mr-2 rounded-right" type="submit"><i class="fas fa-search"></i></button>
                                    <button onclick="window.location.href='{{ route('countries.index') }}'" type="button" class="btn btn-md btn-secondary rounded"><i class="fas fa-sync-alt"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr align="center">
                            <th width="5%">No</th>
                            <th>#</th>
                            <th>Country Code</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($countries as $user => $result)
                            <tr>
                                <td>{{ $user + $countries->firstitem() }}</td>
                                <td align="center">                             
                                    <a href="{{ route('countries.edit', $result->id) }}" type="button" class="btn btn-sm btn-info"><i class="fas fa-pen"></i></a>                                
                                    <a href="javascript:void(0)" id="btn-delete" class="btn btn-sm btn-danger" onclick="deleteData('{{ $result->id }}')" data-toggle="modal" data-target="#deleteUserModal"><i class="fas fa-trash"></i></a>
                                </td>
                                <td>{{ $result->country_code }}</td>
                                <td>{{ $result->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Data Found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Modal Delete -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="javascript:void(0)" id="deleteForm" method="post">
                @method('DELETE')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Delete Country</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" onclick="formSubmit()" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteData(id) {
            let url = '{{ route("countries.destroy", ":id") }}';
            url     = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection