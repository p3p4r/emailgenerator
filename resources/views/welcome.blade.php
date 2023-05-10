@extends('layouts.app')

@section('title', 'Bi - Generate Email')

@section('content')

<div class="container">
    <div class="row">
       <!--  <img  class="logo" src="{{url('/images')}}/blueinfinity_big.png" alt="Blue-Infinity"> -->
       <div class="main_dv">
            <i class="far fa-envelope" style="font-size: 11em;color: #00afe1;"></i>
            <h1 class="bi">Generate Email </h1>
            <div class="bi-btn-animated ">
              <a class="btn btn-custom btn-animated" style="padding: 10px 16px;font-size: 20px;margin-top: 20px;" href="{{ route('generatehtml.create') }}" title="">Generate Email</a>
            </div>
       </div>

      
       
    </div>
     <div class="copyright">
          <p class="bi"> &copy; 2018  Blue Trinity  </p>
       </div>
</div>


@endsection('content')