<!DOCTYPE html>
<html lang="en">
    @include('layouts.head')
    <body>
        @extends('layouts.app')
        @include('layouts.sidebar')
        @include('layouts.navbar')
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h4 class="mb-4 text-center">Edit Product</h4>
                    <form method="POST" action="{{ route('update', $item->id) }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" value="{{ $item->ProductName }}" id="name" name="ProductName" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <label for="desc" class="form-label">Product Description</label>
                            <input type="text" class="form-control" value="{{ $item->ProductDesc }}" name="ProductDesc" id="desc">
                        </div>
                        
                        <div class="mb-3">
                            <label for="price" class="form-label">Product Price</label>
                            <input type="text" class="form-control" value="{{ $item->ProductPrice }}" name="ProductPrice" id="price">
                        </div>
                        
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Product Quantity</label>
                            <input type="text" class="form-control" value="{{ $item->ProductQuantity }}" name="ProductQuantity" id="quantity">
                        </div>
                        
                        <div class="mb-3">
                            <label for="img" class="form-label">Product Media</label>
                            <input type="file" class="form-control" value="{{ $item->ProductMedia }}" name="ProductMedia" id="img">
                            <img src="{{ asset('assets/img/' . $item->ProductMedia) }}" alt="" width="50%" class="my-4">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Create Product</button>
                        
                    </form>
                </div>
            </div>
        </div>
</div>
@include('layouts.footer')
</div>
    @include('layouts.script')
</body>
</html>