<!doctype html>
<html lang="en">
  <head>
    <title>Laravel Multiple Images Upload Using Dropzone</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="_token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center font-weight-bold">Laravel 6 Multiple Images Upload Using Dropzone</h4>
                <form method="post" action="" enctype="multipart/form-data"
                            class="dropzone" id="dropzone">
                @csrf
                </form>
            </div>
        </div>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    {{-- <script src="{{ asset('assets/plugins/dropzone/js/dropzone.js') }}"></script> --}}


    <script type="text/javascript">
        Dropzone.options.dropzone =
         {
            maxFilesize: 10, //cantidad de archivos que se cargararn
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            removedfile: function(file)
            {
                var name = file.upload.filename;
                console.log('hola', name)
                $.ajax({
                    // headers: {
                    //             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    //         },                           
                    type: 'POST',
                    url: '{{ route("prueba.eliminar") }}',
                    // dataType:'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        filename: name
                        },
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});

                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function(file, response)
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }
        };

        </script>

<script>
    $("form#dropzone").dropzone({ url: "prueba/guardar" });
</script>
 </body>
</html>

