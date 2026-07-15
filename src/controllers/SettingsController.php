<?php

require_once 'AppController.php';

class SettingsController extends AppController {

    public function index() {
        $this->render("settings"); 
    }
}