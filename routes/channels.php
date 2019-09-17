<?php

use App\User;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Below code added by sanjith
Broadcast::channel('user', function () {
   // return $user->id == $toUserId;
   return true;
});
// Channel for broadcasting messages.
Broadcast::channel('user', function (User $user) {
    // return $user->id == $toUserId;
    return $user;
 });

 Broadcast::channel('chat', function (User $user) {
    // return $user->id == $toUserId;
    return $user;
 });

 Broadcast::channel('chatprivate', function (User $user) {
   // return $user->id == $toUserId;
   return $user;
});