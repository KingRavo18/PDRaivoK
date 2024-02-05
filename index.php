<!DOCTYPE html>
<html lang="en">
<head>
    <title>Message Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                event.preventDefault();
                
                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: 'be/save.php',
                    data: formData,
                    success: function(response) {
                        $('#response').html(response);
                        $('form')[0].reset();
                        fetchMessages();
                    }
                });
            });

            function fetchMessages() {
                $.ajax({
                    type: 'GET',
                    url: 'be/fetch.php',
                    success: function(data) {
                        $('#messages').html(data);
                    }
                });
            }
            fetchMessages();
        });
    </script>
</head>
<body>
    <h2>Write stuff</h2>
    <form>
        <input type="text" name="name" placeholder="name" ><br><br>
        <input type="email" name="email" placeholder="email" ><br><br>
        <textarea name="message" placeholder="message"></textarea><br><br>
        <input type="submit" value="Submit">
    </form>
    <div id="response"></div>
    <h2>Messages</h2>
    <table id="messages">
    </table>
</body>
</html>
