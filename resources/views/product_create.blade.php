@extends('master')
@section('body')
    <h3>Create new Product</h3>
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" value="" class="form-control">
        @if ($errors->has('name'))
            <h5 class="text-danger">{{ $errors->first('name') }}</h5>
        @endif
        <br>
        <label for="prot">Product Type</label>
        <select name="prot" id="" class="form-control">
            <option value="">--Select Product Type--</option>
            @foreach ($proT as $pt)
                <option value="{{ $pt->id }}">
                    {{ $pt->ProductType }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('prot'))
            <h5 class="text-danger">{{ $errors->first('prot') }}</h5>
        @endif
        <br>
        <label for="info">Decription: </label>
        <textarea name="info" id="" class="form-control"></textarea> <br>
        <label for="Price">Price: </label>
        <input type="number" name="Price" value="" class="form-control">
        @if ($errors->has('Price'))
            <h5 class="text-danger">{{ $errors->first('Price') }}</h5>
        @endif
        <br>
        <label for="Stock">Stock: </label>
        <input type="number" name="Stock" value="" class="form-control">
        @if ($errors->has('Stock'))
            <h5 class="text-danger">{{ $errors->first('Stock') }}</h5>
        @endif
        <br>
        <label for="image">Image:</label>
        <input type="file" accept="image/*" name="image" id="box" onchange="showImage()"> <br>
        <div id="displayImage">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@stop
@section('js')
    <script>
        function showImage() {
            let imgSelected = document.querySelector('#box').files;
            if (imgSelected.length > 0) {
                let fileToLoad = imgSelected[0];
                let fileReader = new FileReader();
                fileReader.onload = function(fileLoaderEvent) {
                    let srcData = fileLoaderEvent.target.result;
                    var newImage = document.createElement('img');
                    newImage.src = srcData;
                    document.getElementById('displayImage').innerHTML = newImage.outerHTML;
                }
                fileReader.readAsDataURL(fileToLoad);
            }
        }
    </script>
@stop
