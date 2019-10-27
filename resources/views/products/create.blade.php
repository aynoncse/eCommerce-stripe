@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ isset($product)?'Edit Product':'Create Product' }}</div>

            <div class="card-body">
                @include('partials.errors')
                <form action="{{isset($product)?route('products.update', $product->id):route('products.store')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @if(isset($product))
                    @method('PUT')
                    @endif
                    <div class="form-group">
                        <label class="form-control-label">Product Name</label>
                        <input class="form-control" type="text" name="name" value="{{isset($product)?$product->name:''}}" required />
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Price</label>
                        <input class="form-control" type="text" name="price" onkeypress="return numbersOnly(event)" value="{{isset($product)?$product->price:''}}"/>
                    </div>

                    @if(isset($product))
                    <div class="form-group">
                        <img src="{{ asset($product->image)}}" alt="" style="width: 250px; height:200px">
                    </div>
                    @endif
                    <p>Image:</p>
                    <div class="custom-file mb-2">
                        <input type="file" name="image" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input id="description" value="{{isset($product)?$product->description:''}}" type="hidden" name="description" required>
                        <trix-editor input="description"></trix-editor>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ isset($product)?'Update':'Add Product' }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/select2.min.js') }} "></script>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

<script>

// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
      }
      form.classList.add('was-validated');
  }, false);
  });
}, false);
})();
function numbersOnly(e) // Numeric Validation
{
    var unicode=e.charCode? e.charCode : e.keyCode
    if (unicode!=8 && e.key !='.'){
        if ((unicode<2534||unicode>2543)&&(unicode<48||unicode>57))
        {
            return false;
        }
    }
}

</script>

@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
@endsection