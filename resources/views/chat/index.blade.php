<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .message-bubble {
            max-width: 70%;
        }

        .message-sender {
            background-color: #007bff;
            color: white;
            float: right;
        }

        .message-receiver {
            background-color: #e9ecef;
            color: black;
            float: left;
        }

        .conversation-link {
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div id="app" class="max-w-xl mx-auto my-8">
        <div class="flex">
            <div class="w-1/4 bg-gray-200 px-4 py-6">
                <h1 class="text-lg font-bold mb-4">Conversations</h1>
                <ul id="conversations">
                    <!-- Conversations will be loaded here -->
                </ul>
            </div>
            <div class="w-3/4 px-4 py-6">
                <div id="messages" class="border-b pb-4"></div>
                <input type="hidden" id="to_user_id" value="">
                <div class="flex mt-4">
                    <input type="text" id="message"
                        class="w-full rounded-l-lg py-2 px-4 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white">
                    <button id="send"
                        class="px-8 rounded-r-lg bg-blue-500  text-white font-bold p-2 uppercase border-blue-500 border-t border-b border-r">Send</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Function to fetch and display message history
        function fetchMessageHistory(toUserId) {
            $.ajax({
                url: '/message/history/' + toUserId,
                method: 'GET',
                success: function(response) {
                    // Empty the messages container
                    $('#messages').empty();
                    // Check if messages exist in the response
                    if (response.messages && response.messages.length > 0) {
                        // Loop through the messages and append them to the messages container
                        response.messages.forEach(function(message) {
                            var messageClass = (message.sender_id ==
                                    '{{ auth()->id() }}') ?
                                'message-sender' : 'message-receiver';
                            $('#messages').append(
                                '<div class="flex mb-2"><div class="message-bubble py-2 px-4 rounded-lg ' +
                                messageClass + ' inline-block">' + message.message +
                                '</div></div>');
                        });
                    } else {
                        // Handle case when no messages are returned
                        $('#messages').append('<p>No messages found</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error display
                    $('#messages').append('<p>Error loading messages</p>');
                }
            });
        }

        // Function to fetch new messages
        function fetchNewMessages() {
            var toUserId = $('#to_user_id').val();
            $.ajax({
                url: '/message/latest/' + toUserId,
                method: 'GET',
                success: function(response) {
                    if (response.messages && response.messages.length > 0) {
                        response.messages.forEach(function(message) {
                            var messageClass = (message.sender_id ==
                                    '{{ auth()->id() }}') ?
                                'message-sender' : 'message-receiver';
                            $('#messages').append(
                                '<div class="flex mb-2"><div class="message-bubble py-2 px-4 rounded-lg ' +
                                messageClass + ' inline-block">' + message.message +
                                '</div></div>');
                        });
                    }
                    setTimeout(fetchNewMessages, 2000); // Fetch new messages every 2 seconds
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    setTimeout(fetchNewMessages, 2000); // Retry after 2 seconds if an error occurs
                }
            });
        }

        // Function to fetch conversations
        function fetchConversations() {
            $.ajax({
                url: '/conversations',
                method: 'GET',
                success: function(response) {
                    // Empty the conversations container
                    $('#conversations').empty();
                    // Check if conversations exist in the response
                    if (response && response.length > 0) {
                        // Loop through the conversations and append them to the conversations container
                        response.forEach(function(conversation) {
                            $('#conversations').append(
                                '<li class="mb-2 conversation-link" data-sender-id="' + conversation
                                .id + '">' +
                                conversation.name + '</li>'
                            );
                        });
                    } else {
                        // Handle case when no conversations are returned
                        $('#conversations').append('<p>No conversations found</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error display
                    $('#conversations').append('<p>Error loading conversations</p>');
                }
            });
        }

        $(document).ready(function() {
            // Call the function to fetch conversations when the page loads
            fetchConversations();

            $('#send').click(function() {
                var message = $('#message').val();
                var toUserId = $('#to_user_id').val();

                $.ajax({
                    url: '{{ route('send') }}',
                    method: 'POST',
                    data: {
                        to_user_id: toUserId,
                        message: message,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        $('#message').val('');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Fetch and display conversation messages when a conversation is selected
            $('body').on('click', '.conversation-link', function(event) {
                event.preventDefault();
                var senderId = $(this).data('sender-id');
                $('#to_user_id').val(senderId);
                fetchMessageHistory(senderId);
            });

            // Fetch new messages every 2 seconds
            fetchNewMessages();
        });
    </script>

</body>

</html>
