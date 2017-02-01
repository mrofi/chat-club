;(function($) {
	$.get('rest.php', function(data) {
		initChat(data);
	});

	function initChat(user) {
		var conn = new WebSocket('ws://'+window.location.hostname+':8888'),
			$chatcount = $("#chatcount"),
			$inputMsg = $("#msginput"),
			$chatwindow = $("#message-line-area"),
			$userlist = $("#member-list");

		conn.onmessage = function(e) {
			translateMessage(e.data);
		}

		conn.onopen = function() {
			conn.send('{"user": {"username" : "' + user.username + '", "initial" : "' + user.initial + '", "color": "' + user.color + '"}, "tipo": "userconnecting"}');
		}

		$inputMsg.on('keyup', function(e) {
			var $this = $(this);
			var shifted = e.shiftKey;
			var empty = $this.val() == '';

			if ($this.val() == '' || $this.val() == '\n') {
                $this.val('');
				return;
			}

			if (!shifted && e.keyCode === 13) {
				sendMessage($this);
			}
		});

		function sendMessage($msg) {
			var data = '{"tipo": "message", "msg": "' + $msg.val() + '"}';
			conn.send(data);
			$msg.val('');
			$msg.keyup();
		}

		function receiveMessage(msg) {
			var msg = buildMessage(msg.msg, msg.username, msg.initial, msg.color, msg.timestamp);

			msg.addClass('message-line');
			appendMessage(msg);
		}

		function buildMessage(txt, username, initial, color, timestamp) {
			var content = initial && '<div class="char-image"><div class="img" style="background: '+color+';"> <div class="char-init">'+initial+'</div> </div></div>';
			content += username && '<div class="char-name" style="color: '+color+';">'+username+'</div>';
			content += timestamp && '<div class="chat-timestamp">'+timestamp+'</div>';
			content += '<div class="chat-message">'+txt+'</div>';

			$html = $("<div />");
			$html.html(content);
			return $html;
		}

		function appendMessage($msg) {
			$chatwindow.append($msg);
			$chatwindow.scrollTop($chatwindow[0].scrollHeight);
			window.scrollTo(0, document.body.clientHeight);
		}

		function translateMessage(jsontxt) {
			var json = $.parseJSON(jsontxt);

			switch(json.tipo) {
				case 'mainmessage':
					receiveMessage(json);
					break;
				case 'userconnected':
					addNewUser(json);
					break;
				case 'inituserslist':
					initUsersList(json);
					break;
				case 'userdisconneted':
					showUserDisconnected(json.username);
					break;

			}
		}

		function showUserDisconnected(username) {
			var msg = buildMessage("user \"" + username + "\" disconnected");

			msg.addClass('others alert alert-error');
			appendMessage(msg);
		}

		function addNewUser (data) {
			var userCount = data.total,
				newUser = data.username;

			appendNewUser(newUser, userCount);
		}

		function appendNewUser (newUsername, total) {
			$chatcount.empty().html(total);
			$userlist.append($("<li />", { text: newUsername }));
		}

		function initUsersList (data) {
			$chatcount.empty().html(data.total);

			var list = "";
			if (data.users.length) {
				data.users.forEach(function(val) {
					list += '<li>' + val.username + '</li>';
				});
			};
			
			$userlist.empty().append(list);
		}
	}
})(jQuery);