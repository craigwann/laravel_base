<?php

class ironQuestGuard extends Illuminate\Auth\Guard
{
  function checkAccess ($level) {
      return ($this->user->userType->level >= intval($level));
  }
}