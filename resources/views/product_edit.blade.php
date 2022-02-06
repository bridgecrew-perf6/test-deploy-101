@extends('master')
@section('body')
<h3>Update Product</h3>
<form action="{{ route('product.update',$pro) }}" method="post" enctype="multipart/form-data">
@csrf
@method('PATCH')
<label for="name">Name</label>
<input type="text" name="name" value="{{ $pro->name }}" class="form-control">
<br>
<label for="prot">Product Type</label>
<select name="prot" id="" class="form-control">
    <option value="">--Select Product Type--</option>
    @foreach ($proT as $pt)
        <option value="{{ $pt->id }}" @if($pt->id == $pro->Category_Id) selected @endif>
       {{  $pt->ProductType }}
        </option>
    @endforeach
</select> <br>
<label for="info">Decription: </label>
<textarea name="info" id="" class="form-control">{{ $pro->info }}</textarea> <br>
<label for="Price">Price: </label>
<input type="number" name="Price" value="{{ $pro->Price }}" class="form-control"> <br>
<label for="Stock">Stock: </label>
<input type="number" name="Stock" value="{{ $pro->Stock }}" class="form-control"> <br>
<label for="image">Image:</label>
<img src="{{ $pro->image }}" style="width:50px;height:50px;object-fit:cover" alt="">
<input type="file" accept="image/*" name="image" id="box" onchange="showImage()"> <br>
<div id="displayImage">
</div>
<button type="submit" class="btn btn-success">Save</button>
</form>
@stop
@section('js')
<script>

    function showImage()
    {
        let imgSelected = document.querySelector('#box').files;
        if(imgSelected.length > 0)
        {
            let fileToLoad = imgSelected[0];
            let fileReader = new FileReader();
            fileReader.onload = function(fileLoaderEvent)
            {
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
