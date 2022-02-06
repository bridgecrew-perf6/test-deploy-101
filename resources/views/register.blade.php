@extends('master')

@section('body')
    <h2>Đăng Ký</h2>
    <form action="{{ route('register_post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Họ Tên</label>
            <input type="text" name="name" class="form-control">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" class="form-control">
            <button class="btn btn-sm btn-success"> Xác Nhận </button>
        </div>
    </form>
@stop
