@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Products</div>

    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$product->name}}<br></td>
                    <td>{{$product->price}}<br></td>
                    <td><a href="{{route('products.edit', $product->id)}}" class="btn btn-sm btn-primary" title="">Edit</a></td>
                    <td><button id="#delete-btn" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id='{{$product->id}}'>
                        Delete
                    </button></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{$products->links()}}

        <!-- The Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="POST" id="deletePostForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="cat_id" value="" placeholder="">
                            <p class="text-bold">
                                Are you sure to delete this product?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                            <button type="submit" class="btn btn-danger">Yes Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('#deleteModal').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data('id');
        var form = document.getElementById('deletePostForm');
        form.action = '{{route('products.destroy', '')}}'+'/'+id; 
    });

</script>
@endsection