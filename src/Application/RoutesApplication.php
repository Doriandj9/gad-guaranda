<?php
namespace App\Application;

use App\Controllers\Agentes;
use App\Controllers\Api;
use App\Controllers\Home;
use App\Controllers\Login;
use App\Frame\Autentification;
use App\Frame\Routes;
use App\Models\Locacion;
use App\Models\Locales;
use App\Models\Propietarios;
use App\Models\Usuarios;

/**
 * La clase contiene el direcionamiento de las rutas hacia los 
 * controladores 
 */
class RoutesApplication implements Routes {
    /**
     * Son los usuarios como el administrador
     * 
     * @var Usuarios
     */
    private $usuarios;
    /**
     * Son los locales ingresados
     * 
     * @var Locales
     */
    private $locales;
    /**
     * Son los links de la locaciones de GDA
     * 
     * @var  Locacion
     */
    private $locacion;
    /**
     * Son los propietarios de los locales comerciales
     * 
     * @var Propietarios
     */
    private $propietarios;
    /**
     * Sirve para verificar que un usuario ingreso correctamente
     * sus datos para logearse
     * 
     * @var 
     */
    private $autentification;
    public function __construct()
    {
       $this->usuarios = new Usuarios;
       $this->locales = new Locales;
       $this->locacion = new Locacion;
       $this->propietarios = new Propietarios;
       $this->autentification = new Autentification($this->usuarios,'id','clave');

    }

    /**
     * Contienen todas las rutas
     */
    public function getRoutes(): array
    {
        $apiController = new Api(
            $this->usuarios,
            $this->locales,
            $this->locacion,
            $this->propietarios
        );
        $homeController = new Home;
        $loginController = new Login($this->autentification);
        $agentesController = new Agentes($this->usuarios);

        return [
            '' => [
                'GET' => [
                    'controller' => $homeController,
                    'action' => 'home'
                ]
                ],
            'documentation/api' => [
                'GET' => [
                    'controller' => $apiController,
                    'action' => 'documentation'
                ]
                ],
            'admin/login' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'login'
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'saveLogin'
                ]
                ],
            'instructions/general'=> [
                'GET' => [
                    'controller' => $homeController,
                    'action' => 'instruccion'
                ]
                ],
            'add/agentes' =>[
                'GET' => [
                    'controller' => $agentesController,
                    'action' => 'view'
                ],
                'POST' => [
                    'controller' => $agentesController,
                    'action' => 'saveAgente'
                ],
                'login' => true,
                'permission' => Usuarios::ADMINISTRADOR
            ],
            'logout' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'logOut'
                ]
                ],
            'error' => [
                    'GET' => [
                        'controller' => $homeController,
                        'action' => 'error'
                    ]
                    ],
            'error/404' => [
                        'GET' => [
                            'controller' => $homeController,
                            'action' => 'error404'
                        ]
                        ],
             /**---------------------------------------------Rutas de la API-------------------------------- */
             /**
              * Todas las rutas que se van a usar para consultar,insertar,actualizar y borrar con la API
              * Deberan comenzar con api/** 
              */
            'api/agentes-municipales' => [
                'GET' => [
                    'controller' => $apiController,
                    'action' => 'getAgentes'
                ],
                'POST' => [
                    'controller' => $apiController,
                    'action' => 'addAgentes'
                ],
            ],
            'api/locales-comerciales' =>  [
                'GET' => [
                    'controller' => $apiController,
                    'action' => 'getLocales'
                ],
                'POST' => [
                    'controller' => $apiController,
                    'action' => 'addLocales'
                ],
            ],
            'api/locaciones' => [
                'GET' => [
                    'controller' => $apiController,
                    'action' => 'getLocaciones'
                ],
                'POST' => [
                    'controller' => $apiController,
                    'action' => 'addLocacion'
                ],
            ],
               
        ];
    }

    public function autentification(): Autentification
    {
        return $this->autentification;
    }
    public function hasPermission($permission): bool
    {
        $user = $this->autentification->getUser();

        return $user->hasPermission($permission);
    }
}