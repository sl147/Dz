<?php

/**
 * Класс контроллера сайта
 *
 * @author DOM
 */
class SiteController {


    public function actionIndex() {
        $listTasks = Task::getTasksAllVue();

        require_once ('views/site/index.php');
        return true;    
    }

  
}