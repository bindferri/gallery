<?php

class Photo extends Parent_methods {

    protected static $db;
    protected static $db_table = "photos";
    protected static $db_table_fields = array('photo_title','photo_caption','photo_description','photo_filename','photo_alternate_text','photo_type','photo_size','comments');
    public $photo_id;
    public $photo_title;
    public $photo_description;
    public $photo_filename;
    public $photo_type;
    public $photo_size;
    public $comments;
    public $photo_caption;
    public $photo_alternate_text;

    public $tmp_path;
    public $errors = array();
    public $upload_directory = "uploads";
    public $upload_errors_array = [
      UPLOAD_ERR_OK => 'There is no error',
      UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize',
        UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE',
        UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload'
    ];

    public function __construct(){
        self::$db = new Database();
    }

    public function set_file($file){
        if (empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded here";
            return false;
        }elseif ($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }else{
            $this->photo_filename = basename($file['name']);
            $this->photo_size = $file['size'];
            $this->photo_type = $file['type'];
            $this->tmp_path = $file['tmp_name'];
        }
    }

    public function createPhoto(){
        if (empty($this->errors)){
            $this->create($this->photo_title,$this->photo_caption,$this->photo_description,$this->photo_filename,$this->photo_alternate_text,$this->photo_type,$this->photo_size,$this->comments);
            $target_path = APP_ROOT."\\admin\\".$this->upload_directory."\\".$this->photo_filename;
            move_uploaded_file($this->tmp_path,$target_path);
            return true;
        }else{
            $this->errors[] = "Can't do it buddy";
           return false;
        }
    }

    public function deletePhoto ($id){
        $this->photo_filename = $this->findById($id)->photo_filename;
        $target_path = APP_ROOT."\\admin\\".$this->upload_directory."\\".trim($this->photo_filename);
        unlink($target_path);
        $this->deleteById($id);
    }

    public function limitPhotos($offset,$items_per_page){
        self::$db->query("SELECT * FROM photos LIMIT $offset,$items_per_page");
        return self::$db->fetchAll();
    }

}