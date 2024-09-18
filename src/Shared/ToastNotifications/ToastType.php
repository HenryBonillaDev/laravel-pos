<?php

namespace Src\Shared\ToastNotifications;

enum ToastType: string
{
    case SUCCESS = 'success';
    case WARNING = 'warning';
    case ERROR = 'error';
}
