
{{-- <script>
$boton.addEventListener("click", function() {
    
    // Codificarlo como JSON
    //Pausar reproducción
    $video.pause();
        //Obtener contexto del canvas y dibujar sobre él
        let contexto = $canvas.getContext("2d");
        $canvas.width = $video.videoWidth;
        $canvas.height = $video.videoHeight;
        contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);
        
        let foto = $canvas.toDataURL(); //Esta es la foto, en base 64
        let datafoto=encodeURIComponent(foto);
            var data1 = {
                "tokenmodalfoto": $('#tokenfoto').val(),
                "idpatient":$('#patient-id').val(),
                "idimage":$('#imagen-id').val(),
                "pic":datafoto
                };
        const datos=JSON.stringify(data1)
        $estado.innerHTML = "Enviando foto. Por favor, espera...";
        fetch("{{ route('checkin.avatar') }}", {
            method: "POST",
            body: datos,
            headers: {
                "Content-type": "application/x-www-form-urlencoded",
                'X-CSRF-TOKEN': data1.tokenmodalfoto,// <--- aquí el token
            },
        }).then(function(response) {
            // console.log(response.json());
                return response.json();
            }).then(nombreDeLaFoto => {
                // nombreDeLaFoto trae el nombre de la imagen que le dio PHP
                console.log("La foto fue enviada correctamente");
                $estado.innerHTML = `Foto guardada con éxito. Puedes verla <a target='_blank' href='./${nombreDeLaFoto}'> aquí</a>`;
            })
        //Reanudar reproducción
        $video.play();

        $('.avatar-preview').load(
            $('#imagePreview').css('background-image', 'url({{ Storage::url($rs->patient->image->path) }})'),
            $('#imagePreview').hide(),
            $('#imagePreview').fadeIn(650)
        );        
        });
</script> --}}

    <script>

    
    var carga = {}
    var borrar ;
    Dropzone.options.myDropzone = {
        
        url: "{{ route('save.history', $rs) }}",
        autoProcessQueue: true,
        parallelUploads: 100,
        uploadMultiple: true,
        maxFiles: 10,
        maxFilesize:10,
        addRemoveLinks: true,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
    
        // accept: function(file) {
        //     let fileReader = new FileReader();
    
        //     fileReader.readAsDataURL(file);
        //     fileReader.onloadend = function() {
    
        //         let content = fileReader.result;
        //         console.log('hols', content)
    
        //         $('#files2').append('<input type="file" name="file[]" id="files" value="'+content+'" multiple/>')
        //         // $('#files').val(content);
                
        //         file.previewElement.classList.add("dz-success");
        //     }
        //     file.previewElement.classList.add("dz-complete");
            
        // }
        success: function (file, response) {
            // myDropzone = this
            // console.log('trae', myDropzone);
            // console.log('trae', file.name);
            var cargar = $('#my-dropzone').append('<input type="hidden" name="file" class="'+file.name+'" id="examenb" value="'+file.name+'">')
            carga[file.name] = response.name
            // var data = $('input[name="file[]"]').filter('examenb');
            console.log('ysbe',file.name)
            // for(var i=0; i<data.length; i++){
    
            // console.log('trae', data[i]);
            // }
        //   borrar = file.name;
        },
    
    
        removedfile: function(file) {
        var name = file.name;
        console.log('trae', name);
        
            if(file.name != null){
                var id= $('#my-dropzone');
                $('.dropzone').remove(id.val());
                console.log('borrado');
            }
        }
        
    }
    
    // myDropzone.on("complete", function(file) {  
    //   myDropzone.removeFile(file);
      
    // });
    
    // ("#examenb").hide();
    //     console.log('hola')
    
    // $(document).on('click', '#examen', function(event) {
    //                 // let id = this.name;
    // // $("#examen").click(function(){
    //     console.log('hola');
    //     var borrar = $(this).val();
    //         // let borrar = this.val();
    //         console.log(borrar);
    //          $("."+borrar).remove();
    //         //  padre = imagen.parentNode;
    //         // padre.removeChild(imagen);
    //         // window.location = “borrar.HTML”;
    
    //         //  $("div").remove("#quitar"+data[$i].id); //quitar del modal
    //     });
    
    //  Dropzone.options.myDropzone = {
    //             url: "{{ route('save.history', $rs) }}",
    //             autoProcessQueue: true,
    //             uploadMultiple: true,
    //             parallelUploads: 100,
    //             maxFiles: 10,
    //             maxFilesize:10,
    //             // acceptedFiles: "image/*",
    
    //             init: function () {
    
    //                 var submitButton = document.querySelector("#submit-all");
    //                 var wrapperThis = this;
    
    //                 submitButton.addEventListener("click", function () {
    //                     e.preventDefault();
    //                     e.stopPropagation();
    //                     wrapperThis.processQueue();
    //                 });
    
    //                 this.on("addedfile", function (file) {
    
    //                     // Create the remove button
    //                     var removeButton = Dropzone.createElement("<button class='btn btn-danger mt-2 text-center'><i class='fa fa-remove'></i></button>");
    
    //                     // Escucha el evento click
    //                     removeButton.addEventListener("click", function (e) {
    //                         // Asegúrese de que el clic del botón no envíe el formulario:
    //                         e.preventDefault();
    //                         e.stopPropagation();
    
    //                         // Eliminar la vista previa del archivo.
    //                         wrapperThis.removeFile(file);
    //                         // Si también quieres eliminar el archivo en el servidor,
    //                         // puedes hacer la solicitud AJAX aquí.
    //                     });
    
    //                     // Agregue el botón al elemento de vista previa del archivo.
    //                     file.previewElement.appendChild(removeButton);
    //                 });
                    
    //             }
    //         };
    </script>