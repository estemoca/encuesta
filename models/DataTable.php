<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class DataTable {
    
   protected static $_instance = null;

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return (self::$_instance);
    }
    
    public function getAllPacientes(){
        $Action = new Action();
        $dbCon = Initializer::getInstance()->getDb();
        $stmt = $dbCon->prepare("SELECT p.id as id ,p.nombre as Nombre , p.apellido as Apellidos, p.direccion as Direccion ,
                                        p.celular as Celular, p.telefono as Telefono, m.nombre as Municipio, e.nombre as Eps FROM pacientes p
                                        LEFT JOIN municipios m on m.id =p.id_municipio 
                                        LEFT JOIN eps e on e.id =p.id_eps 
                                        LEFT JOIN departamentos d on d.id =m.id_departamento 
                                        order by p.nombre asc");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } 
    public function getAllEps(){
        $Action = new Action();
        $dbCon = Initializer::getInstance()->getDb();
        $stmt = $dbCon->prepare("SELECT * FROM eps order by nombre asc");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    public function getAllDepartamentos(){
        $Action = new Action();
        $dbCon = Initializer::getInstance()->getDb();
        $stmt = $dbCon->prepare("SELECT * FROM departamentos order by nombre asc");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);   
        return $rows;
    }
    public function getmunicipiosbydepartamento($id){
        $Action = new Action();
        $dbCon = Initializer::getInstance()->getDb();
        $stmt = $dbCon->prepare("SELECT * FROM municipios WHERE id_departamento=".$id." order by nombre asc");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);   
        return $rows;
    }
    public function createPaciente($paciente){  
        var_dump($paciente['id']);exit();
        $empleadoUpdate = $this->getPaciente($paciente['id']);
        var_dump($empleadoUpdate);exit();
        if(!empty($empleadoUpdate)){
            $response = $this->updatePaciente($paciente);
        }else{        
            $dbCon = Initializer::getInstance()->getDb();
            $query = "INSERT INTO `pacientes`(`nombre`, `apellido`, `direccion`, `celular`, `telefono`,
                                                        `id_municipio`, `id_eps`, `fecha_creacion`)
                                                VALUES ('" . $paciente['nombre'] . "','" . $paciente['apellido'] . "','" . $paciente['direccion'] . "','" . $paciente['celular'] . "','" . $paciente['telefono'] . "',
                                                        '" . $paciente['municipio'] . "','" . $paciente['eps'] . "','" . date('Y-m-d') . "')";
            $stmt = $dbCon->prepare($query);
            $response = $stmt->execute();
        }        
        return $response;
    }  
    public function getPaciente($id){     
        $dbCon = Initializer::getInstance()->getDb();
        $stmt = $dbCon->prepare("SELECT * FROM pacientes where id=".$id." limit 1");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);        
        return $rows[0];
    }
    public function getMunicipio($id){     
        $dbCon = Initializer::getInstance()->getDb();
        $stmt = $dbCon->prepare("SELECT * FROM municipios where id=".$id." limit 1");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);        
        return $rows[0];
    }
    public function deletePaciente($id){
        $dbCon = Initializer::getInstance()->getDb();
        $query="DELETE FROM `pacientes` WHERE id=".$id;
        $stmt = $dbCon->prepare($query);
        $response = $stmt->execute();
        return $response;
    }   
     public function updatePaciente($emp){        
        $dbCon = Initializer::getInstance()->getDb();
        $query="UPDATE `empleado` SET 
                                `nom_emp`='".$emp['nom_emp']."',`cargo_emp`='".$emp['cargo_emp']."',`dep_emp`='".$emp['dep_emp']."',`cod_sede`='".$emp['cod_sede']."',
                                `fec_emp`='".$emp['fec_emp']."',`cod_esciv`='".$emp['cod_esciv']."',`dir_emp`='".$emp['dir_emp']."',`ema_emp`='".$emp['ema_emp']."',`cel_emp`=".$emp['cel_emp'].",
                                `tel_emp`=".$emp['tel_emp'].",`cod_vivi`=".$emp['cod_vivi'].",`varri_emp`=".$emp['varri_emp'].",`cod_escri`=".$emp['cod_escri'].",`escri_emp`='".$emp['escri_emp']."',
                                `vivpro_emp`='".$emp['vivpro_emp']."',`elec_emp`='".$emp['elec_emp']."',`cod_comp`=".$emp['cod_comp'].",`comp_emp`=".$emp['comp_emp'].",`cod_inter`=".$emp['cod_inter'].",
                                `cod_fcomp`=".$emp['cod_fcomp'].",`fcomp_emp`=".$emp['fcomp_emp'].",`cod_nivest`=".$emp['cod_nivest'].",`nivest_emp`='".$emp['nivest_emp']."',`estend_emp`=".$emp['estend_emp'].",
                                `cod_curs`=".$emp['cod_curs'].",`curs_emp`='".$emp['curs_emp']."',`cod_eps`=".$emp['cod_eps'].",`cod_ceps`=".$emp['cod_ceps'].",`cod_caeps`=".$emp['cod_caeps'].",
                                `eps_emp`='".$emp['eps_emp']."',`cod_cacomp`=".$emp['cod_cacomp'].",`cod_ccacomp`=".$emp['cod_ccacomp'].",`cod_cacacomp`=".$emp['cod_cacacomp'].",`cacomp_emp`='".$emp['cacomp_emp']."',
                                `afun_emp`=".$emp['afun_emp'].",`nfun_emp`='".$emp['nfun_emp']."',`cod_depor`=".$emp['cod_depor'].",`depor_emp`='".$emp['depor_emp']."',`cdpor_emp`=".$emp['cdpor_emp'].",
                                `cdpnvo_emp`=".$emp['cdpnvo_emp'].",`pasa_emp`='".$emp['pasa_emp']."',`cony_emp`='".$emp['cony_emp']."',`cfec_emp`='".$emp['cfec_emp']."',`cod_ing`=".$emp['cod_ing'].",
                                `cod_oconyu`=".$emp['cod_oconyu'].",`hij_emp`=".$emp['hij_emp'].",`fdi_emp`='".$emp['fdi_emp']."',`bene_emp`='".$emp['bene_emp']."',`comen_emp`='".$emp['comen_emp']."',
                                `ciu_emp`='".$emp['ciu_emp']."' WHERE cod_emp=".$emp['cod_emp'];        
        $stmt = $dbCon->prepare($query);
        $response=$stmt->execute();        
        return $response;
    }                
}