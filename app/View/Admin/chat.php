<section class="sm:ml-64">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .chat-box {
            max-width: 400px;
            margin: 50px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }

        .chat-header {
            background-color: #032FF2;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .chat-body {
            padding: 15px;
            overflow-y: scroll;
            max-height: 300px;
        }

        .message {
            margin-bottom: 15px;
        }

        .message.sender {
            text-align: right;
        }

        .message.receiver {
            text-align: left;
        }

        .message p {
            background-color: #e0e0e0;
            padding: 8px;
            border-radius: 5px;
            margin: 0;
            display: inline-block;
        }

        .message.sender p {
            background-color: #032FF2;
            color: #fff;
        }

        .input-box {
            padding: 10px;
            background-color: #fff;
            border-top: 1px solid #ccc;
        }

        input[type="text"] {
            width: 80%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-right: 5px;
        }

        input[type="submit"] {
            padding: 8px;
            background-color: #032FF2;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
    <div class="chat-box">
        <div class="chat-header"><?= $model['user_email'] ?></div>
        <?php if (isset($model['chat']) && $model['chat'] != null && !isset($model['error'])) { ?>
            <div class="chat-body" id="chatBody">
                <?php foreach ($model['chat'] as $row) { ?>
                    <?php if ($row['sender'] == "Admin") { ?>

                        <div class="message sender" id="sender">
                            <p><?= $row['message'] ?></p>
                        </div>
                    <?php } else if ($row['sender'] == "User") { ?>

                        <div class="message receiver" id="receiver">
                            <p><?= $row['message'] ?></p>
                        </div>
                    <?php } ?>
                <?php } ?>
                <!-- Add more messages as needed -->
            </div>
        <?php } ?>
        <form action="/admin/chat/<?= $model['user_email'] ?>" method="post" class="w-full">
            <input type="hidden" name="user_email" value="<?= $model['user_email'] ?>">

            <div class="input-box">
                <input type="text" id="messageInput" name="admin_message" placeholder="Type your message...">
                <button type="submit" id="sendMsg" onclick="sendMessage()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                        <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
    <!-- <script type="text/javascript">
        $(document).ready(function(){
            $("#send").on("click", function(){
                $.ajax({
                    url:"/user/chat",
                    method:"POST",
                    data:{
                        sender: $("#sender").val(),
                        sender: $("#receiver").val(),
                        sender: $("#messageInput").val(),
                    },
                    dateType:"text",
                    success:function(data){
                        $("#messageInput").val(""); 
                    }
                });
            });
        });
    </script> -->
</section>