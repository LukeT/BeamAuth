<?php

/*
 * (c) Luke Thompson (luke@thompsonuk.me)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// use LukeT\BeamAuth\Listener;
use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
    $events->subscribe(LukeT\BeamAuth\Listener\AddClientAssets::class);
    $events->subscribe(LukeT\BeamAuth\Listener\AddBeamAuthRoute::class);
};