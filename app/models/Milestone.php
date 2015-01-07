<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Milestone extends Eloquent {
    protected $guarded = array('id');

    public function ability() {
        return $this->hasOne('Ability', 'id', 'ability_id');
    }

    public function apiKey() {
        return $this->hasOne('Chrisbjr\ApiGuard\ApiKey', 'user_id', 'id');
    }
}
