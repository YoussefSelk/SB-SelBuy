<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Conversation Sidebar -->
        <div class="bg-gray-800 text-white p-4 w-1/4">
            <h1 class="text-lg font-semibold mb-4">Conversations</h1>
            <ul id="conversation_list">
                <!-- Conversations will be appended here -->
            </ul>
        </div>

        <!-- Chat Container -->
        <div class="flex-1 flex flex-col h-screen">
            <!-- Chat Header -->
            <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
                <h1 class="text-lg font-semibold">Chat</h1>
                <button
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg focus:outline-none focus:ring focus:ring-blue-300">New
                    Chat</button>
            </div>

            <!-- Chat Messages -->
            <div id="chat_area" class="flex-1 p-4 overflow-y-auto">
                <!-- Messages will be appended here -->
            </div>

            <!-- Chat Input -->
            <div class="bg-gray-100 p-4">
                <input type="text" placeholder="Type your message..." id="message"
                    class="w-full border-gray-300 border-2 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300">
                <button id="send"
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg focus:outline-none focus:ring focus:ring-blue-300">Send</button>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to fetch chat history
            function fetchChatHistory(receiverId) {
                $.ajax({
                    type: "GET",
                    url: "/chat/" + receiverId + "/history",
                    success: function(data) {
                        $("#chat_area").html(''); // Clear chat area
                        if (data) {
                            data.forEach(message => {
                                if (message.sent_by_user) {
                                    // Message sent by the user
                                    let senderMessage = `
                                        <div class="flex justify-end items-center mb-4">
                                            <div class="bg-blue-500 text-white max-w-sm py-2 px-4 rounded-lg shadow-md">
                                                <p>${message.message}</p>
                                            </div>
                                            <img src="https://via.placeholder.com/40" alt="User" class="w-8 h-8 ml-2 rounded-full">
                                        </div>`;
                                    $("#chat_area").append(senderMessage);
                                } else {
                                    // Message received by the user
                                    let receiverMessage = `
                                        <div class="flex justify-start items-center mb-4">
                                            <img src="https://via.placeholder.com/40" alt="User" class="w-8 h-8 mr-2 rounded-full">
                                            <div class="bg-gray-200 text-gray-800 max-w-sm py-2 px-4 rounded-lg shadow-md">
                                                <p>${message.message}</p>
                                            </div>
                                        </div>`;
                                    $("#chat_area").append(receiverMessage);
                                }
                            });
                            // Scroll to the bottom of the chat area
                            $("#chat_area").scrollTop($("#chat_area")[0].scrollHeight);
                        } else {
                            toastr.error('Error occurred while fetching chat history.');
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Error occurred while fetching chat history: ' + error);
                    }
                });
            }

            // Fetch chat history when the page loads
            fetchChatHistory({{ $receiver->id ?? 'null' }});

            // Send message
            $("#send").click(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post("/chat/{{ $receiver->id ?? 'null' }}", {
                    message: $("#message").val()
                }).done(function(data, status) {
                    console.log("Data: " + data + "\nStatus: " + status);
                    fetchChatHistory({{ $receiver->id ?? 'null' }});
                    $("#message").val(''); // Clear input after sending message
                }).fail(function(xhr, status, error) {
                    toastr.error('Error occurred while sending message: ' + error);
                });
            });

            // Fetch conversations when the page loads
            function fetchConversations() {
                $.ajax({
                    type: "GET",
                    url: "/conversations",
                    success: function(data) {
                        if (data) {
                            data.forEach(conversation => {
                                let receiverId = conversation.user1.id != {{ auth()->id() }} ?
                                    conversation.user1.id : conversation.user2.id;
                                let receiverName = conversation.user1.id !=
                                    {{ auth()->id() }} ?
                                    conversation.user1.name : conversation.user2.name;
                                let lastMessage = conversation.last_message;
                                let conversationItem = `
                                    <li class="cursor-pointer p-2 hover:bg-gray-700" data-receiver-id="${receiverId}">
                                        <p>${receiverName}</p>
                                        <p>${lastMessage}</p>
                                    </li>`;
                                $("#conversation_list").append(conversationItem);
                            });

                            // Open conversation on click
                            $("#conversation_list li").click(function() {
                                let receiverId = $(this).data("receiver-id");
                                window.location.href = `/chat/${receiverId}`;
                            });
                        } else {
                            toastr.error('No conversations found.');
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Error occurred while fetching conversations: ' + error);
                    }
                });
            }

            // Fetch conversations when the page loads
            fetchConversations();

            var pusher = new Pusher('e9356270b0595810faa9', {
                cluster: 'eu'
            });

            var channel = pusher.subscribe('chat{{ auth()->id() }}');
            channel.bind('chatMessage', function(data) {
                fetchChatHistory({{ $receiver->id ?? 'null' }});
            });
        });
    </script>
</body>

</html>
