@extends('layouts.layout')

@section('title' , 'send sms')


@section('content')
<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                @lang('notification.send_sms')
            </div>
            <div class="card-body">
                
                @if (session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                @endif
                
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif


            <form action="{{ route('notification.send.sms') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="user">@lang('notification.users')</label>
                    
                        <select name="user"  class="form-control" id="user">
                            @foreach ($users as $user)
                            <option {{ old('user') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    
                    </div>

                    <div class="form-group">
                        <label for="text">@lang('notification.message_text')</label>
                        
                        <textarea name="text" id="text" class="form-control" rows="3">{{ old('text') }}</textarea>
                    
                    </div>
                    <ul>
                        @if ($errors->any())
                            
                            <div class="small mb-2">
                                @foreach ($errors->all() as $error)
                                    <li class="text-danger">
                                        {{ $error }}
                                    </li>    
                                @endforeach
                            </div>                        
                            
                        @endif
                    </ul>
                    <button type="submit" class="btn btn-info">@lang('notification.send')</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection