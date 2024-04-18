function getMessages() {
    fetch('getMessages.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        const messageList = document.getElementById('messageList');
    
        // Limpiar el contenedor antes de agregar nuevos mensajes
        messageList.innerHTML = '';
    
        // Recorrer los mensajes y crear elementos HTML para cada uno
        data.forEach(message => {
            // Crear un elemento <li> para el mensaje
            const listItem = document.createElement('li');
            listItem.className = 'in';

            if(message.session === message.username){
                listItem.className = 'out';
            }
            
            // Crear elementos internos
            const chatImg = document.createElement('div');
            chatImg.className = 'chat-img';
            const avatarImg = document.createElement('img');
            avatarImg.alt = 'Avatar';
            avatarImg.src = '../assets/img/' + message.image;
            chatImg.appendChild(avatarImg);
    
            const chatBody = document.createElement('div');
            chatBody.className = 'chat-body';
            const chatMessage = document.createElement('div');
            chatMessage.className = 'chat-message';
            const userHeading = document.createElement('h5');
            userHeading.textContent = message.username;
            const messageParagraph = document.createElement('p');
            messageParagraph.textContent = message.content;
    
            // Construir la estructura del mensaje
            chatMessage.appendChild(userHeading);
            chatMessage.appendChild(messageParagraph);
            chatBody.appendChild(chatMessage);
    
            listItem.appendChild(chatImg);
            listItem.appendChild(chatBody);
    
            // Agregar el elemento <li> al contenedor de mensajes
            messageList.appendChild(listItem);
        });
    })
    .catch(error => {
        console.error('Error al enviar la solicitud:', error);
    });
}

document.getElementById('messageForm').addEventListener('submit', (event) => {
    event.preventDefault();
    fetch('saveMessage.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ content: document.getElementsByName('content')[0].value})
    })
    .then(response => response.json())
    .then(data => {
        if(data == 'false'){
            alert('There was a problem sending the message. Please try again later.')
        }
        let inputElement = document.getElementById('textinput');
        inputElement.value = '';
        inputElement.placeholder = 'Write here...'
        getMessages();
    })
    .catch(error => {
        console.error('Error al enviar la solicitud:', error);
    });
});

getMessages();
setInterval(getMessages, 2000);
