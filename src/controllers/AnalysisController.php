<?php

require_once 'AppController.php';

class AnalysisController extends AppController {

    public function index() {
        $this->render("analysis"); 
    }
}