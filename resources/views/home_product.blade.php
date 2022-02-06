@extends('master')
@section('body')
    <h3 class="text-center"> List Products </h3>
    <a class="navbar-brand" href="" style="color: black">Xin Chào
        {{ Auth::user()->name }}
        <span>
            <form action="{{ route('logout') }}" method="get">
                <button class="btn btn-sm btn-primary" type="submit">Đăng Xuất</button>
            </form>
        </span>
    </a>
    <table class="table table-light text-center table-bordered">
        <thead class="thead-dart">
            <tr>
                <th>Name</th>
                <th>Info</th>
                <th>Image</th>
                <th>Price</th>
                <th>Stock</th>
                <th>
                    <a href="{{ route('product.create') }}" class="btn btn-primary">Add new product</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pro as $p)
                <tr>
                    <td><a href="{{ route('product.show', $p) }}">{{ $p->name }}</a></td>
                    <td>{{ $p->info }}</td>
                    <td><img src="{{ $p->image }}" style="width:50px;height:50px;object-fit:contain" alt=""></td>
                    <td>{{ number_format($p->Price, 3) }} VNĐ</td>
                    <td>{{ $p->Stock }}</td>
                    <td>
                        @can('update', $p)
                            <a href="{{ route('product.edit', $p) }}" class="btn btn-info">Edit product</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
