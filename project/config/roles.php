<?php

/*
Here, all the roles smust be stored and the key must be in numeric order:

Example:

return [
    0 = Admin,
    1 = Client
]

*/

use App\Enums\UserRolesEnum;

return [
    0 => UserRolesEnum::ADMIN
];
