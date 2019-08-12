<?php

$router->get('', 'ControllerMain@index');
$router->post('checkExistsEmail', 'ControllerMain@checkExistsEmail');
$router->post('saveUserInfo', 'ControllerMain@saveUserInfo');
$router->post('updateUserInfo', 'ControllerMain@updateUserInfo');
$router->get('participants', 'ControllerParticipants@index');
