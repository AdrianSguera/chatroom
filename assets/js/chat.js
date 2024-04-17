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
            listItem.className = 'in'; // Añadir clase 'in'
    
            // Crear elementos internos
            const chatImg = document.createElement('div');
            chatImg.className = 'chat-img';
            const avatarImg = document.createElement('img');
            avatarImg.alt = 'Avatar';
            avatarImg.src = message.avatar;
            chatImg.appendChild(avatarImg);
    
            const chatBody = document.createElement('div');
            chatBody.className = 'chat-body';
            const chatMessage = document.createElement('div');
            chatMessage.className = 'chat-message';
            const userHeading = document.createElement('h5');
            userHeading.textContent = message.nombre;
            const messageParagraph = document.createElement('p');
            messageParagraph.textContent = message.contenido;
    
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
getMessages();
setInterval(getMessages, 5000);
