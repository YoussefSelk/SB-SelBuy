<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom scrollbar styles */
        #conversations-container::-webkit-scrollbar {
            width: 2px;
        }

        #conversations-container::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #conversations-container::-webkit-scrollbar-thumb {
            background: #888;
        }

        #conversations-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="max-w-screen-md mx-auto p-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Conversations</h1>
        <div id="conversations-container" class="space-y-4">
            <!-- Conversations will be dynamically loaded here -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadConversations() {
                $.ajax({
                    url: '/conversations',
                    type: 'GET',
                    success: function(data) {
                        $('#conversations-container').empty();
                        if (data.length > 0) {
                            $.each(data, function(index, conversation) {
                                let receiverId = conversation.user1.id != {{ auth()->id() }} ?
                                    conversation.user1.id : conversation.user2.id;
                                let receiverName = conversation.user1.id !=
                                    {{ auth()->id() }} ?
                                    conversation.user1.name : conversation.user2.name;
                                var html = `
                                    <div class="conversation-card flex items-center justify-between bg-white rounded-lg shadow-md p-4 mb-4 cursor-pointer hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1" data-conversation-id="${receiverId}">
                                        <div class="flex items-center">
                                            <i class="fas fa-comment-dots text-2xl text-blue-500 mr-4"></i>
                                            <p class="text-gray-900 font-semibold">Conversation with ${receiverName}</p>
                                        </div>
                                        <i class="fas fa-chevron-right text-gray-500"></i>
                                    </div>
                                `;
                                $('#conversations-container').append(html);
                            });
                        } else {
                            $('#conversations-container').append(
                                '<p class="text-gray-800">No conversations found</p>');
                        }
                    }
                });
            }

            loadConversations();

            $(document).on('click', '.conversation-card', function() {
                var conversationId = $(this).data('conversation-id');
                window.location.href = '/chat/' + conversationId;
            });
        });
    </script>
</body>

</html>
