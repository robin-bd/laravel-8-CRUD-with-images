@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())

        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif


    {!! Form::open(array('route' => 'products.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
    
         <div class="row">

		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>		            
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
		        </div>
		    </div>

		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detail:</strong>
                    {!! Form::textarea('detail', null, array('placeholder' => 'Detail','class' => 'form-control')) !!}		            
		        </div>
		    </div>


		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Price:</strong>
                    {!! Form::number('price', null, array('placeholder' => 'Price','class' => 'form-control')) !!}
		        </div>
		    </div>            

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Product Image:</strong>
                    {!! Form::file('image', null) !!}                    
                </div>
            </div>            

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-primary">Submit</button>
		    </div>

		</div>
    </form>


<p class="text-center text-primary"><small>by Noor E Alam</small></p>

@endsection