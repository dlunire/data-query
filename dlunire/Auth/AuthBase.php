<?php

namespace Framework\Auth;

use DLCore\Auth\DLAuth;
use Framework\Config\Token;

/**
 * Autenticación base
 * 
 * @package Framework\Auth
 * 
 * @version 1.0.0 (release)
 * @author Códigos del Futuro <contact@dlunire.pro>
 * @copyright 2024 Códigos del Futuro
 * @license MIT
 */
abstract class AuthBase extends DLAuth {
    use Token;
}
