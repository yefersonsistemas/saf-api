@extends('dashboard.layouts.app')

@section('css')

@endsection

@section('title','Modificar clase de doctor')

@section('content')
@can('modificar clase de doctor')
<div class="section-body py-4">
    <div class="container-fluid">
        <form action="{{route('clase.update', $type->id)}}" method='POST' class="row d-flex justify-content-center">
            @method('PUT')
            @csrf
            <div class="card p-4 col-lg-12 col-md-12 col-sm-12">
                <div class="card p-4">
                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ $type->name }}" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group"> 
                                <label class="form-label">Comisión</label>
                                <input type="text"  class="form-control validanumericos" placeholder="Comisión" name="comission" value="{{ $type->comission }}" required>
                            </div>
                        </div> 
                    </div>
                </div>
           

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <div class="btn-group-toggle mb-2 mt-3 d-flex justify-content-end" style="text-align:center">
                    <button  type="submit" class="btn mr-2 pr-4 pl-4 text-white bg-verdePastel" >Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endcan
@endsection


@section('scripts')

<script>
onload = function(){ 
  var ele = document.querySelectorAll('.validanumericos')[0];
  ele.onkeypress = function(e) {
     if(isNaN(this.value+String.fromCharCode(e.charCode)))
        return false;
  }
  ele.onpaste = function(e){
     e.preventDefault();
  }
}
</script>
@endsection
