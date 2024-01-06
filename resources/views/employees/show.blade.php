@extends('layouts.app')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 mt-4">
                <div class="card p-4">
                    <p>Name : <b>{{ $employee->name }}</b></p>
                    <p>Gender : <b>{{ $employee->gender}}</b></p>
                    <p>DOB : <b>{{ $employee->dob }}</b></p>
                    <p>Salary : <b>{{ $employee->salary }}</b></p>
                    <p>Joining Date : <b>{{ $employee->joining_date }}</b></p>
                    <p>Relieving Date : <b>{{ $employee->relieving_date }}</b></p>
                    <p>Contact Number : <b>{{ $employee->contact_number }}</b></p>
                    <p>Email : <b>{{ $employee->email }}
                </div>
            </div>
        </div>
    </div>
@endsection
