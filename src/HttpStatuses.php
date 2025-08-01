<?php

namespace JsonApi;

class HttpStatuses
{
    public const STATUS_OK = 200;
    public const STATUS_ACCEPTED = 202;
    public const STATUS_CREATED = 201;
    public const STATUS_NO_CONTENT = 204;

    public const STATUS_MULTIPLE_CHOICES = 300;
    public const STATUS_MOVED_PERMANENTLY = 301;
    public const STATUS_FOUND = 302;
    public const STATUS_SEE_OTHER = 303;
    public const STATUS_NOT_MODIFIED = 304;
    public const STATUS_TEMPORARY_REDIRECT = 307;
    public const STATUS_PERMANENT_REDIRECT = 308;

    public const STATUS_BAD_REQUEST = 400;
    public const STATUS_UNAUTHORIZED = 401;
    public const STATUS_FORBIDDEN = 403;
    public const STATUS_NOT_FOUND = 404;
    public const STATUS_METHOD_NOT_ALLOWED = 405;
    public const STATUS_NOT_ACCEPTABLE = 406;
    public const STATUS_CONFLICT = 409;
    public const STATUS_GONE = 410;
    public const STATUS_UNPROCESSABLE_ENTITY = 422;

    public const STATUS_INTERNAL_SERVER_ERROR = 500;
    public const STATUS_NOT_IMPLEMENTED = 501;
    public const STATUS_BAD_GATEWAY = 502;
    public const STATUS_SERVICE_UNAVAILABLE = 503;
}
