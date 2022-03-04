<?php
    require_once 'Db.php';
    class Crud extends Db{
       // $insert_data = array(
       //     'username' => 'abu hasib',
       //     'pass' => $password,
        //);

        public function insert($table_name,$data){
            if(!empty($data)){
                $fields = $placeholder = [];

                foreach($data as $field => $value){
                    $fields[] = $field;
                    $placeholder[] = ":{$field}";
                }
            }

            $sql = "INSERT INTO {$table_name} (" .implode(',', $fields) .") VALUES(". implode(',', $placeholder). ")";
            $stmt = $this->db->prepare($sql);

            try{
                $stmt->execute($data);
                $this->db->commit();
                $insert_id = $this->db->lastInsertId();
                return $insert_id;
                
            } catch(PDException $e){
                echo "Error:". $e->getMessage();
            }
        }
    }
?>