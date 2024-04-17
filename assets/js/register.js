$('.pass').on('input', ()=> {
    if(($('#typePasswordX').val() == $('#repeatPasswordX').val()) && $('#typePasswordX').val().length > 3){
        $('#register-btn').prop('disabled', false)
    } else {
        $('#register-btn').prop('disabled', true);
    }
});

$('#typeUsernameX').change(() => {
    let username = $('#typeUsernameX').val();

    fetch('checkUser.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ data: username })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error al enviar la solicitud:', error);
    });
});