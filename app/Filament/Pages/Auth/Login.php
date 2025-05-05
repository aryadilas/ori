<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms;

class Login extends BaseLogin
{

    protected static string $view = 'filament.pages.auth.login';

    protected static string $layout = 'filament.components.layout.simple';

}
