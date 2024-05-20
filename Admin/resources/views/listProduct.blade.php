<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<style>
    img,video{
        aspect-ratio: 3/2;
        object-fit: contain;
    }
</style>
<body>
@extends('layouts.app')
@include('layouts.sidebar')
@include('layouts.navbar')
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded-top p-4">
        <div class="row">
            <div class="col-12 col-sm-12">
                <table class="table table-bordered table-responsive table-hover rounded-2 text-justify table-responsive">
                    <thead>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Product Image</th>
                    </thead>
                    <tbody>
                    @foreach ($products as $item)
                    <tr>
                        <td>{{$item->ProductName}}</td>
                        <td><textarea minlength="5" maxlength="10" cols="30" rows="0" class="form-control bg-secondary" disabled>{{$item->ProductDesc}}</textarea></td>
                        <td>{{$item->ProductPrice}}</td>
                        <td>{{$item->ProductQuantity}}</td>
                        <td style="width: 20%">                        
                            @if(pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'mp4' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'mov' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'wmv' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'flv' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == '3gp' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'avi' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'mng' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'ogv' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'ogx' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'ts' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'mts' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'f4v' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'f4p' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'f4b' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'f4p' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'f4b' || pathinfo($item->ProductMedia, PATHINFO_EXTENSION) == 'webm')
                            <video class="card-img-top" controls>
                                <source src="{{ asset('assets/img/' . $item->ProductMedia) }}" type="video/{{ pathinfo($item->ProductMedia, PATHINFO_EXTENSION) }}">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <img class="card-img-top" src="{{ asset('assets/img/' . $item->ProductMedia) }}" alt="{{ $item->ProductName }}">
                        @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
</div>
<!-- Sale & Revenue End -->
@include('layouts.script')        
</body>
</html>

