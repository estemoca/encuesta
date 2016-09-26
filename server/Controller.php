<?php

class Controller extends Action {

    public $ajaxResponse = array("success" => false);

    public function index() {
        
    }
         
    public function loadepsXHR(){
       $eps = DataTable::getInstance()->getAllEps();
       echo json_encode($eps);
       exit();
    }
    public function loaddepartamentosXHR(){      
       $departamentos = DataTable::getInstance()->getAllDepartamentos();
       echo json_encode($departamentos);
       exit();
    }
    public function getmunicipiosbydepartamentoXHR(){
       $municipios = DataTable::getInstance()->getmunicipiosbydepartamento($_POST['id']);
       echo json_encode($municipios);
       exit();
    }
    
    public function createpacienteXHR(){             
       $createPaciente = DataTable::getInstance()->createPaciente($_POST);       
       echo json_encode($createPaciente);
       exit();        
    }
    public function getpacienteXHR(){             
       $getPaciente = DataTable::getInstance()->getPaciente($_POST['id']);       
       echo json_encode($getPaciente);
       exit();        
    }
    public function getmunicipioXHR(){                
       $getmunicipio = DataTable::getInstance()->getMunicipio($_POST['id']);       
       echo json_encode($getmunicipio);
       exit();        
    }
    public function deletepacienteXHR(){             
       $deletePaciente = DataTable::getInstance()->deletePaciente($_POST['id']);       
       echo json_encode($deletePaciente);
       exit();        
    }    
}
