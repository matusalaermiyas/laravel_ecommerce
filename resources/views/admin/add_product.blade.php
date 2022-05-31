@extends('layouts.main')

@section('title', 'Add Product')

@section('content')

    <div class="row">
        <div class="col-sm-7 col-sm-offset-1">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <form action="{{route('root.add-product')}}" method="post" class="col-sm-7 col-sm-offset-1" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" name="title" id="name" required value="xyz">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="text" class="form-control" name="quantity" id="quantity" required value="10">
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" id="price" required value="344.44">
            </div>

            <div class="form-group">
                <label for="delivery_fee">Delivery Fee</label>
                <input type="text" class="form-control" name="delivery_fee" id="delivery_fee" required value="24.44">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="tshirts">T-Shirts</option>
                    <option value="shorts">Shorts</option>
                    <option value="underwears">Underwears</option>
                    <option value="trousers">Trousers</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image_url">Image</label>
                <input type="file" name="image_url" id="image_url" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>
                Nice product
            </textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-info">Add</button>
            </div>
        </form>
    </div>

    @if (Session::has('admin-added'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                SoloAlert.alert({
                    title: "Item Added Successfully, to store",
                    icon: "success"
                });
            })
        </script>
    @endif

@endsection
