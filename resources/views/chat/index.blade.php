<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex flex-col h-screen">
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
            <button id="send">Send</button>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to fetch chat history
            function fetchChatHistory() {
                $.ajax({
                    type: "GET",
                    url: "/chat/{{ $receiver->id }}/history",
                    success: function(data) {
                        data.forEach(message => {
                            if (message.sent_by_user) {
                                // Message sent by the user
                                let senderMessage = '' +
                                    '<div class="flex justify-end items-center mb-4">' +
                                    '<div class="bg-blue-500 text-white max-w-sm py-2 px-4 rounded-lg shadow-md">' +
                                    '<p>' + message.message + '</p>' +
                                    '</div>' +
                                    '<img src="https://via.placeholder.com/40" alt="User" class="w-8 h-8 ml-2 rounded-full">' +
                                    '</div>';
                                $("#chat_area").append(senderMessage);
                            } else {
                                // Message received by the user
                                let receiverMessage = ' ' +
                                    '<div class="flex justify-start items-center mb-4">' +
                                    '<img src="https://via.placeholder.com/40" alt="User" class="w-8 h-8 mr-2 rounded-full">' +
                                    '<div class="bg-gray-200 text-gray-800 max-w-sm py-2 px-4 rounded-lg shadow-md">' +
                                    '<p>' + message.message + '</p>' +
                                    '</div>' +
                                    '</div>';
                                $("#chat_area").append(receiverMessage);
                            }
                        });
                        // Scroll to the bottom of the chat area
                        $("#chat_area").scrollTop($("#chat_area")[0].scrollHeight);
                    }
                });
            }

            // Fetch chat history when the page loads
            fetchChatHistory();

            // Send message
            $("#send").click(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.post("/chat/{{ $receiver->id }}", {
                        message: $("#message").val()
                    },
                    function(data, status) {
                        console.log("Data: " + data + "\nStatus: " + status);
                        let senderMessage = '' +
                            '<div class="flex justify-end items-center mb-4">' +
                            '<div class="bg-blue-500 text-white max-w-sm py-2 px-4 rounded-lg shadow-md">' +
                            '<p>' + $("#message").val() + '</p>' +
                            '</div>' +
                            '<img src="https://via.placeholder.com/40" alt="User" class="w-8 h-8 ml-2 rounded-full">' +
                            '</div>';
                        $("#chat_area").append(senderMessage);
                        $("#message").val(''); // Clear input after sending message
                        // Scroll to the bottom of the chat area
                        $("#chat_area").scrollTop($("#chat_area")[0].scrollHeight);
                    }
                )
            })
            Pusher.logToConsole = true;
            var pusher = new Pusher('e9356270b0595810faa9', {
                cluster: 'eu'
            });

            var channel = pusher.subscribe('chat{{ Auth::user()->id }}');
            channel.bind('chatMessage', function(data) {
                if (data.sent_by_user) {
                    // Message sent by the user
                    let senderMessage = '' +
                        '<div class="flex justify-end items-center mb-4">' +
                        '<div class="bg-blue-500 text-white max-w-sm py-2 px-4 rounded-lg shadow-md">' +
                        '<p>' + data.message + '</p>' +
                        '</div>' +
                        '<img src="https://via.placeholder.com/40" alt="User" class="w-8 h-8 ml-2 rounded-full">' +
                        '</div>';
                    $("#chat_area").append(senderMessage);
                } else {
                    // Message received by the user
                    let receiverMessage = ' ' +
                        '<div class="flex justify-start items-center mb-4">' +
                        '<img src="https://via.placeholder.com/40" alt="User" class="w-8 h-8 mr-2 rounded-full">' +
                        '<div class="bg-gray-200 text-gray-800 max-w-sm py-2 px-4 rounded-lg shadow-md">' +
                        '<p>' + data.message + '</p>' +
                        '</div>' +
                        '</div>';
                    $("#chat_area").append(receiverMessage);
                }
                // Scroll to the bottom of the chat area
                $("#chat_area").scrollTop($("#chat_area")[0].scrollHeight);
            });
        });
    </script>
</body>

</html>
