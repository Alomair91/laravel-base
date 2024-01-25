<?php

namespace omairtech\laravel\base\enums;

class HttpStatus
{
    const OK = 200;
    const CREATED = 201;

    const ERROR = 400;
    const VALIDATION_ERROR = 422;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;

    const INTERNAL_SERVER_ERROR = 500;
    const BAD_GATEWAY_ERROR = 502;
}
