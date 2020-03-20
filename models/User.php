<?php

namespace app\models;


class User extends DataEntity
{
    public $id;
    public $login;
    public $password;
    public $firstName;
    public $lastName;
}