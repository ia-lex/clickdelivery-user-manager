@extends('base.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Information</div>
                <div class="panel-body">
                    <button 
                        type="button" 
                        class="btn btn-info btn-xs" 
                        data-toggle="modal"     
                        data-target="#manager-modal"
                        onclick="loadUser({{Auth::user()}})" 
                    >
                        Update my personal information
                    </button>

                    @if(Auth::user()->role_id == 1)
                    <button 
                        id="new-user-btn" 
                        type="button" 
                        class="btn btn-success btn-xs" 
                        data-toggle="modal"     
                        data-target="#create-modal" 
                    >
                        Create new user
                    </button>
                    @endif

                    @if(Auth::user()->role_id != 3 && Auth::user()->able_to_read)
                    <div class="responsive-table">
                        <h2>Users</h2>
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Active</th>
                                <th>Able to read</th>
                                @if(Auth::user()->role_id == 1)
                                <th>Update</th>
                                <th>Delete</th>
                                @endif
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->email }} </td>
                                <td> {{ $user->phone_number }} </td>
                                <td> {{ $user->role->name }} </td>
                                <td> {{ $user->activate ? 'YES' : 'NO' }} </td>
                                <td> {{ $user->able_to_read ? 'YES' : 'NO' }} </td>
                                @if(Auth::user()->role_id == 1 && $user->id != Auth::user()->id)
                                <td>
                                    <button 
                                        type="button"
                                        class="btn btn-info btn-xs"
                                        data-toggle="modal"
                                        data-target="#manager-modal"
                                        onclick="loadUser({{ $user }})" 
                                    >
                                        Update User
                                    </button>                                    
                                </td>
                                <td>
                                    <button 
                                        type="button"
                                        class="btn btn-danger btn-xs"
                                        data-toggle="modal"
                                        data-target="#delete-modal"
                                        onclick="deleteUser({{ $user }})" 
                                    >
                                        Delete User
                                    </button>                                    
                                </td>
                                @else
                                <td></td>
                                <td></td>
                                @endif
                            </tr>
                            @endforeach
                        </table>
                        <div class="pagination"> {{ $users->links() }} </div>
                    </div>
                    @elseif (Auth::user()->role_id == 2)
                    <div class="alert alert-info top-separate">
                        <p>You are not able to see users information</p>
                    </div>
                    @else
                    @endif
                </div>                    
            </div>
        </div>
    </div>
    @include('auth.manager-update-modal')
    @include('auth.create-modal')
    @include('auth.delete-modal')
</div>
@endsection