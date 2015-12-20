<?php
require_once './Connections.php';

class Filess{
    
    static function upload($width,$height){
        if(!isset($_FILES["image"])){
            return NULL;
        }
        
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        
        $conn=(new Database())->getConnection();
        $stmt=$conn->prepare("INSERT INTO images (id) VALUES (NULL)");
        $stmt->execute();
        $id=$conn->lastInsertId();
        
        $size=getimagesize($file_tmp);
        
        if($size==FALSE){
            throw new Exception("It's not an image");
        }
        
        if($size[0]!=$width||$size[1]!=$height){
            throw new Exception("Sizes don't match");
        }
        
        if($file_size > 16*1024*1024){
            throw new Exception("File should be less than 16M");
        }
        
        
        
        if(!move_uploaded_file($file_tmp, "images/".$id)){return false;}
        chmod("images/".$id, 0744);
        return $id;
    }
    
    static function delete($id){
        unlink("images/".$id);
        
    }
    
}

