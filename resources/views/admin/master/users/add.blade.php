@extends('layouts.admin.master')

@section('title')
    Dashboard
@endsection

@section('content')

    <div class="row gy-4">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-4 gap-2 gap-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"
                        ><i class="mdi mdi-account-outline mdi-20px me-1"></i>Account</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-notifications.html"
                        ><i class="mdi mdi mdi-account-key mdi-20px me-1"></i>Access Role</a
                        >
                    </li>
                </ul>

                <div class="card mb-4">
                    <h4 class="card-header">Profile Details</h4>
                    <div class="card-body pt-2 mt-1">
                        <form action="{{route('admin.master.users.store')}}" method="post">
                            @csrf
                            <div class="row mt-2 gy-4">
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="hidden" id="editable" name="editable"
                                               value="{{($editable) ? 'true' : 'false'}}" placeholder="Name"/>
                                        <input class="form-control" type="text" id="name" name="name"
                                               value="{{($editable) ? $data->name : ''}}" placeholder="Name" autofocus/>
                                        <label for="firstName">Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="text" id="email" name="email"
                                               value="{{($editable) ? $data->email : ''}}" placeholder="Email"/>
                                        <label for="email">E-mail</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" class="form-control" id="password" name="password"
                                               value="" placeholder="Password"/>
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" class="form-control" id="re-password" name="re-password"
                                               value="" placeholder="Re Enter Password"/>
                                        <label for="re-password">Re-Type Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2"><span
                                        class="tf-icons mdi mdi-content-save-check me-1"></span>Save User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
