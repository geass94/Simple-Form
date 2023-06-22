<?php

namespace Service;

interface NotificationService
{
    public function send(string $text);
}