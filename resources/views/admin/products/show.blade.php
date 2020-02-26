@extends('admin.layouts.master')
@section('title', 'Product Details')

@section('content')
    <div class="section-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Product Details</div>

                    <div class="card-body">
                        Product Name: {{$product->name}} <br/><br/>

                        Product Description : {{$product->description}} <br/><br/>


                        Image: <img src="{{env('APP_URL').$product->getFirstMediaUrl('images', 'thumb')}}"/>
                        <hr/>
                        Image: <img src="{{env('APP_URL').$product->getFirstMediaUrl('images', 'square')}}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
