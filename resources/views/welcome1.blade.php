<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>

      <h1>New Users</h1>

      <ul>
        <li v-repeat="user: users">@{{ user }}</li>
      </ul>

      <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>

      <script>
          var socket = io('http://192.168.10.10:3000');
          new Vue({
            el: "body",

            data: {
                users: []
            },

            ready: function() {
                socket.on('test-channel:UserSignedUp', function(data){
                    this.users.push(data.username);
                }.bind(this));
            }
          });

      </script>
    </body>
</html>
