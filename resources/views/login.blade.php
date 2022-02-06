@extends('master');

@section('body')
    <form action="{{ route('login_post') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control">
            @if ($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
            @if ($errors->has('password'))
                <p class="text-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <label for="">remember <input type="checkbox" name="remember" value="true"></label>
        <button type="submit" class="btn btn-sm btn-primary d-block">Login</button>
        <a href="{{ route('admin.create') }}">Đăng Ký</a>
    </form>
@stop
