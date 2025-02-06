<?php

use App\Models\User;

$user = User::find(1);

$user->competencias()->attach($competencia_id);
