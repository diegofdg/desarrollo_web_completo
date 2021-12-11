<?php 

namespace Model;

use MVC\Router;


class Admin extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->email = $args['id'] ?? '';
        $this->password = $args['id'] ?? '';
    }
}