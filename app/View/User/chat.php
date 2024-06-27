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
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
    <div class="chat-box">
        <div class="chat-header">MindJourney</div>
        <div class="chat-body" id="chatBody">
            <div class="message receiver" id="receiver">
                <p>Halo ada yang bisa kami bantu?</p>
            </div>
            <div class="message receiver" id="receiver">
                <p>Kamu bisa menanyakan apapun mengenai permasalahanmu</p>
            </div>
            <?php if (isset($model['chat']) && $model['chat'] != null && !isset($model['error'])) { ?>
                <?php foreach ($model['chat'] as $row) { ?>
                    <?php if ($row['sender'] == "User") { ?>

                        <div class="message sender" id="sender">
                            <p><?= $row['message'] ?></p>
                        </div>
                    <?php } else if ($row['sender'] == "Admin") { ?>

                        <div class="message receiver" id="receiver">
                            <p><?= $row['message'] ?></p>
                        </div>
                    <?php } ?>
                <?php } ?>
                <!-- Add more messages as needed -->
            <?php } ?>
        </div>
        <form action="/user/chat" method="post" class="w-full">
            <input type="hidden" name="user_email" value="<?= $model['user_email'] ?>">
            <div class="input-box">
                <input type="text" id="messageInput" name="user_message" placeholder="Type your message...">
                <button type="submit" id="sendMsg" onclick="sendMessage()" class="bg-biru rounded-lg p-2 text-dark-white">
                    Kirim
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