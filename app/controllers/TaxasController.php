<?php
/**
 * Created by PhpStorm.
 * User: claudiohenrique
 * Date: 08/03/15
 * Time: 03:19
 */

class TaxasController extends BaseController {

    public function setTaxa($valor_taxa){
        $taxa = new Taxa;
        $taxa->taxa = $valor_taxa;
        if($taxa->save()){
            echo json_encode(
                array(
                    'status' => 200,
                     'message' => 'Taxa adicionada',
                )
            );
        }
    }

    public function message($id){
        echo $id;
    }
}