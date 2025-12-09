<?php

namespace App;

enum UserType: string
{
    case SuperAdmin = 'superAdmin';
    case Doctor = 'doctor';
    case Receptionist = 'receptionist';
}
