 @extends('master')
 @section('body')
     <h3>Product Detail</h3>
     <label>Name: </label> {{ $pro->name }} <br>
     <label>ProductType: </label>
     {{ $pro->category->ProductType }} <br>
     <label for="">Description: </label>{{ $pro->info }} <br>
     <label for="">Stock: </label>{{ $pro->Stock }} <br>
     <label for="">Price: </label>{{ $pro->Price }} <br>
     <label for="">Image: </label>
     <img src="{{ $pro->image }}" style="width:50px;height:50px;object-fit:cover" alt="">
     <hr>
     {{-- @can('update', $pro) --}}
     <form action="{{ route('product.destroy', $pro) }}" method="POST">
         @csrf
         @method('DELETE')
         <button class="btn btn-primary">Delete</button>
     </form>
     <a href="{{ route('product.edit', $pro) }}">Edit product</a>
     {{-- @endcan --}}
 @stop
