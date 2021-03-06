<?php
class BaseModel{
    function __construct()
    {
        $host = "127.0.0.1";
        $dbname = 'pt14314-web';
        $dbusername = 'root';
        $dbpass = "123456";
        $this->connect = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",
                                        $dbusername, $dbpass);
    }

    public static function getAll(){
        $model = new static();
        $sql = "select * from " . $model->table;
        $stmt = $model->connect->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
        return $data;
    }

    public static function destroy($id){

        try{
            $model = new static();
            $sql = "delete from " . $model->table . " where id = $id";
            $stmt = $model->connect->prepare($sql);
            $stmt->execute();
            return true;
        }catch (Exception $ex){
            var_dump($ex->getMessage());
            return false;
        }
    }
}
?>