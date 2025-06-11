{{-- <!DOCTYPE html>
<html>
<head>
  <title>Pusher Test</title>
  <meta charset="UTF-8">
  <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
</head>
<body>
  <h1>Pusher Listening...</h1>

  <script>
    // ✅ Enable logging to see errors in dev
    Pusher.logToConsole = true;

    // ✅ Replace with your actual key and cluster
    const pusher = new Pusher('061e5401ac489a5bb229', {
      cluster: 'ap1',
      forceTLS: true
    });

    // ✅ Subscribe to public channel
    const channel = pusher.subscribe('my-channel');

    // ✅ Listen to event name (NO DOT)
    channel.bind('my-event', function (data) {
      alert('📢 Message: ' + data.message + '\n🕒 Time: ' + data.time);
      console.log('✅ Received from Pusher:', data);
    });
  </script>
</body>
</html> --}}
