function loadChat(chatName) {
    var chatContainer = document.getElementById("chat-container");

    // Clear the current chat content
    chatContainer.innerHTML = '';

    // Load the new chat content
    var chatBox = document.createElement('div');
    chatBox.className = 'chat-box';

    // Sample messages for the chat
    var messages = [
        { type: 'received', text: 'Hello, this is the ' + chatName },
        { type: 'sent', text: 'Hi, How are you?' },
        // Add more messages as needed
    ];

    messages.forEach(function(message) {
        var messageDiv = document.createElement('div');
        messageDiv.className = 'message ' + message.type;
        var p = document.createElement('p');
        p.textContent = message.text;
        messageDiv.appendChild(p);
        chatBox.appendChild(messageDiv);
    });

    chatContainer.appendChild(chatBox);

    var inputBox = document.createElement('div');
    inputBox.className = 'input-box';

    var input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'Write a message...';

    var button = document.createElement('button');
    button.textContent = 'Send';

    inputBox.appendChild(input);
    inputBox.appendChild(button);

    chatContainer.appendChild(inputBox);
}