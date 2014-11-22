<?php

class ironQuestGuard extends Illuminate\Auth\Guard
{
  function checkAccess ($accessId) {
      return ($this->user->userType->id <= intval($accessId));
  }
}