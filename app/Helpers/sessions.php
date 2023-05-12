<?php

use App\Sessions;

function deleteSessionByMaxUsers()
{
    $sessions = Sessions::getAllUserSessions(Auth::id());
    if ($sessions->count() >= (int)settings('max_user_devices'))
        Sessions::deleteOldSession(Auth::id());
}

function deleteAllUserSessions(){
    $sessions = Sessions::getAllUserSessions(Auth::id());
    if ($sessions->count() > 0)
        Sessions::deleteOldSession(Auth::id());
}

