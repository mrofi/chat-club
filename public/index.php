<?php
session_start();

if (!isset($_POST['user']) && !isset($_SESSION['user'])) {
    header('location:login.php');
}

if (isset($_POST['user'])) {
    $username = $_POST['user']['username'];
    $usernames = explode(' ', $username);
    $first = array_shift($usernames);
    $last = '';
    if (count($usernames)) {
        $last = array_pop($usernames);
    }
    $initial = substr($first, 0, 1).($last != '' ? substr($last, 0, 1) : '');
    $_POST['user']['initial'] = $initial;
    $_SESSION['user'] = $_POST['user'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

    <!-- Optional theme -->
    <link rel="stylesheet" href="/css/chat.css">
    <link rel="stylesheet" href="/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</head>
<body>
    <header>
        <div class="container">
            <div class="row head-title">
                <div class="col-xs-2">
                    <a href="#" class="main-menu visible-xs visible-sm">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="col-xs-8">
                    <p>
                        <span class="full-name hidden-xs">World of Azarezal</span>
                        <span class="initial-name hidden-sm hidden-md hidden-lg">WoA</span>
                        <span class="room-name">: Hall</span>
                    </p>
                </div>
                <div class="col-xs-2">
                    <a href="#" class="main-menu visible-xs visible-sm">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div class="container" id="message-board">
        <div class="row">
            <div class="col-md-2 hidden-xs hidden-sm">
                <div class="message-area">
                    left sidebar
                </div>
            </div>
            <div class="col-xs-12 col-md-8">
                <div id="message-line-area" class="message-area"></div>
            </div>
            <div class="col-md-2 hidden-xs hidden-sm">
                <div id="chat-member" class="message-area">
                    <div class="counter">
                        <span id="chat-member-counter">1</span> user(s) online.
                    </div>
                    <ul id="member-list"></ul>
                </div>
            </div>
        </div>
    </div>
    <div id="chat-board">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <div id="chat-line">
                        <textarea id="msginput" type="text" name="chat" class="form-input"></textarea>
                        <button class="btn btn-chat"><i class="fa fa-send"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="//code.jquery.com/jquery.min.js"></script> -->
    <!-- Latest compiled and minified JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
    <script src="/js/app.js"></script>
    <script>
        $(function(){

            if ($('body').width() > 990) {
                /*global document:false, $:false */
                var txt = $('#chat-line textarea'),
                    hiddenDiv = $(document.createElement('div')),
                    content = null,
                    messageBoard = $('#message-board');

                hiddenDiv.addClass('hiddendiv chat-line-textarea');
                hiddenDiv.css('width', txt.width());

                $('body').append(hiddenDiv);

                txt.on('keyup', function () {

                    content = $(this).val();
                    if (content == '' || content == '\n') {
                        $(this).val('');
                        content = '';
                    }

                    content = content.replace(/\n/g, '<br>');
                    hiddenDiv.html(content + '<br class="lbr">');

                    var newHeight = hiddenDiv.outerHeight();
                    $(this).css('height', newHeight);
                    messageBoard.css('margin-bottom', newHeight + 15);
                    autoHeight();
                });

                var autoHeight = function() {
                    var wrapperHeight = $('header').outerHeight() + $('#chat-line').outerHeight();
                    var bodyHeight = $(window).height() - wrapperHeight;
                    $('.message-area').css('height', bodyHeight);
                    $('#message-line-area').scrollTop(function() {
                        return this.scrollHeight;
                    });
                }

                autoHeight();
            }
        });
    </script>
</body>
</html>