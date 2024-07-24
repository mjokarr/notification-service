@extends('layouts.layout')

@section('title' , 'send email')


@section('content')
<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
            <form action="" method="">
                    <div class="form-group">
                        <label for="user">Users</label>
                        <select name="user"  class="form-control" id="user">
                            <option value="">User</option>
                            <option value="">User</option>
                            <option value="">User</option>
                            <option value="">User</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="text">Email Types</label>
                        <select name="test" id="">
                            <option value="Email Types"></option>
                            <option value="Email Types"></option>
                            <option value="Email Types"></option>
                            <option value="Email Types"></option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">button name</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection