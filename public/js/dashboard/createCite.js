$("#submit").click(function() {
    createPerson();
});

function createPerson() {
    var type_dni = $("#type_dni").val();
    var dni = $("#dni").val();
    var name = $('#name').val()
    var lastname = $('#lastname').val();
    var email = $('#email').val();
    var address = $('#address').val();
    var phone = $('#phone').val();
    var person;

    $('#submit').click(function() {

        $.ajax({
                url: '{{ route("person.create") }}',
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    type_dni: type_dni,
                    dni: dni,
                    name: name,
                    lastname: lastname,
                    email: email,
                    address: address,
                    phone: phone,
                }
            })
            .done(function(data) {
                console.log(data);
                person = data;
                Swal.fire({
                    title: 'Excelente!',
                    text: 'Paciente registrado exitosamente',
                    type: 'success',
                });
            })
            .fail(function(data) {
                console.log(data);
            })
    });
}