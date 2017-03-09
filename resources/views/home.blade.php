@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('product.create') }}" class="btn btn-lg btn-block btn-success">+ Add Product</a>

            <div class="spacer"></div>

            <ul class="list-group">
                @foreach($products as $product)
                    <li class="list-group-item clearfix">
                        <div class="col-md-1">
                            <product-image src="{{ $product->image ? $product->image : 'https://pbs.twimg.com/profile_images/794168141563777024/ccpIqz98.jpg' }}"></product-image>
                        </div>

                        <div class="col-md-9">
                            <dl class="dl-horizontal">
                                <dt>Product:</dt>
                                <dd><a href="{{ $product->url }}" target="_blank">{{ $product->name }}</a></dd>

                                <dt>Desired Size:</dt>
                                <dd>{{ $product->size }}</dd>

                                <dt>In Stock:</dt>
                                <dd>{{ $product->sent_at ? 'Yes' : 'No' }}</dd>
                            </dl>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-block btn-danger" type="button" data-toggle="modal" data-target="#delete-product-{{ $product->id }}">Delete</button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@foreach($products as $product)
    <div class="modal fade" id="delete-product-{{ $product->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm Deletion</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong>{{ $product->name }}</strong></p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
