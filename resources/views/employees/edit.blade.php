@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card mt-3 p-3">
                <h3 class="bg-dark p-1 text-white text-center rounded">Update Employee : {{$employee->name}}  Details</h3>
                <form action="/employees/{{ $employee->id }}/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name',$employee->name) }}"/>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select name="gender" class="form-control">
                            <option value="Male" {{ ($employee && $employee->gender === 'Male') ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ ($employee && $employee->gender === 'Female') ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ ($employee && $employee->gender === 'Other') ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob',$employee->dob) }}"/>
                        @if ($errors->has('dob'))
                            <span class="text-danger">{{ $errors->first('dob') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="salary">Salary:</label>
                        <input type="text" name="salary" class="form-control" value="{{ old('salary',$employee->salary) }}"/>
                        @if ($errors->has('salary'))
                            <span class="text-danger">{{ $errors->first('salary') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="joining_date">Joining Date:</label>
                        <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date',$employee->joining_date) }}">
                        @if ($errors->has('joining_date'))
                            <span class="text-danger">{{ $errors->first('joining_date') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="relieving_date">Relieving Date:</label>
                        <input type="date" name="relieving_date" class="form-control" value="{{ old('relieving_date',$employee->relieving_date) }}">
                        @if ($errors->has('relieving_date'))
                            <span class="text-danger">{{ $errors->first('relieving_date') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="contact_number">Contact Number:</label>
                        <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number',$employee->contact_number) }}">
                        @if ($errors->has('contact_number'))
                            <span class="text-danger">{{ $errors->first('contact_number') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" disable name="email" class="form-control" value="{{ old('email',$employee->email) }}">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" class="form-control">
                            <option value="Active" {{ $employee->status === 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $employee->status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Employee</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
