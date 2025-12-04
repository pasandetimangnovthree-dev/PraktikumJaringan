<?php
namespace Src\Controllers;

class HealthController extends BaseController {
    public function show() {
        $this->ok([
            'status' => 'ok', 
            'time' => date('c'),
            'environment' => $this->cfg['app']['env']
        ]);
    }
    
    public function version() {
        $this->ok([
            'version' => '1.0.0',
            'name' => 'API PHP Native',
            'timestamp' => time()
        ]);
    }
    public function contract() {
     include "api-contract.php";
    }
}