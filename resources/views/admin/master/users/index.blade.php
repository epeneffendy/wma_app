@extends('layouts.admin.master')

@section('title')
    Dashboard
@endsection

@section('content')

<div class="row gy-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">List User</h5>
                    <a href="{{route('admin.master.users.add')}}" class="btn btn-primary"><span class="tf-icons mdi mdi-account-plus-outline me-1"></span>Primary</a>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="table-light">
                        <tr>
                          <th class="text-truncate">Nama</th>
                          <th class="text-truncate">Email</th>
                          <th class="text-truncate">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning"><i class="mdi mdi-file-edit-outline"></i></a>
                                        <a href="#" class="btn btn-danger"><i class="mdi mdi-trash-can-outline"></i></i></a>
                                    </td>
                                </tr>
                            @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
      </div>
</div>

@endsection
