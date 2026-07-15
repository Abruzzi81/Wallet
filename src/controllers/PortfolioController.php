<?php

require_once 'AppController.php';

class PortfolioController extends AppController {

    public function index() {
        $this->render("portfolio"); 
    }
}