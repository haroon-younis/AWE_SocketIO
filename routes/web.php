<?php

use Illuminate\Support\Facades\Redis;

use App\Message;
use App\Events\MessageSent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Return index page with the Vue component we will crete soon
Route::get('/', function () {
    return view('welcome');
});

// Return all messages that will populate our chat messages
Route::get('/getAll', function () {
    $messages = Message::take(200)->pluck('content');
    return $messages;
});

// Allows us to post new message
Route::post('/post', function () {
    $message = new Message();
    $content = request('message');
    $message->content = $content;
    $message->save();

    event(new MessageSent($content)); // fire the event

    return $content;
});


/*
Route::get('/', function () {
    // 1. publish event with redis
    $data = [
        'event' => 'UserSignedUp',
        'data' => [
            'username' => 'JohnDoe'
        ]
    ];

    Redis::publish('laravel_database_test-channel', json_encode($data));

    return view('welcome');

    // 2. Node.js + Redis subscribes to the event

    // 3. Use socket.io to emit to all clients
});
*/
