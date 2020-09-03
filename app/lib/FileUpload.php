<?php
namespace shfretak\lib;

use Exception;

class FileUpload
{
    private $name;
    private $type;
    private $size;
    private $error;
    private $tmpPath;

    private $fileExtension;

    private $allowedExtensions = [
        'jpg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls'
    ];

    /**
     * FileUpload constructor.
     * @param array $file <p> the key of the uploaded file => $_FILES[$file]</p>
     */
    public function __construct(array $file)
    {
        $this->name = $file['name'];
        $this->type = $file['type'];
        $this->size = $file['size'];
        $this->error = $file['error'];
        $this->tmpPath = $file['tmp_name'];
        $this->name();
    }

    /**
     * generate new name for the uploaded file
     * @return false|string|string[]|null
     */
    private function name()
    {
        preg_match_all('/([a-z]{1,4})$/i', $this->name, $m);
        $this->fileExtension = $m[0][0];
        $name = substr(strtolower(base64_encode($this->name . APP_SALT)), 0, 30);
        $name = preg_replace('/(\w{6})/i', '$1_', $name);
        $name = rtrim($name, '_');
        $this->name = $name;
        return $name;
    }

    /**
     * check if the uploaded file is allowed or not
     * @return bool
     */
    private function isAllowedType()
    {
        return in_array($this->fileExtension, $this->allowedExtensions);
    }

    private function isSizeNotAcceptable()
    {
        preg_match_all('/(\d+)([MG])$/i', MAX_FILE_SIZE_ALLOWED, $matches);
        $maxFileSizeToUpload = $matches[1][0];
        $sizeUnit = $matches[2][0];
        $currentFileSize = ($sizeUnit == 'M') ? ($this->size / 1024 / 1024) : ($this->size / 1024 / 1024 / 1024);
        $currentFileSize = ceil($currentFileSize);
        return (int) $currentFileSize > (int) $maxFileSizeToUpload;
    }

    /**
     * check the type of uploaded file is image or not
     * @return false|int
     */
    private function isImage()
    {
        return preg_match('/image/i', $this->type);
    }

    /**
     * return the file name with their extension
     * @return string <p> the file name </p>
     */
    public function getFileName()
    {
        return $this->name . '.' . $this->fileExtension;
    }

    /**
     * the uploader function : <p> upload the valid file and manage it </p>
     * @return $this
     * @throws Exception
     */
    public function upload()
    {
        if($this->error != 0) {
            throw new Exception('message_failed_upload');
        }elseif(!$this->isAllowedType()) {
            throw new Exception('message_not_allowed_type');
        } elseif ($this->isSizeNotAcceptable()) {
            throw new Exception('message_file_big');
        } else {
            $storageFolder = $this->isImage() ? IMAGES_UPLOAD_PATH : DOCUMENTS_UPLOAD_PATH;
            if(is_writable($storageFolder)) {
                move_uploaded_file($this->tmpPath, $storageFolder . DS . $this->getFileName());
            } else {
                throw new Exception('message_destination_not_writable');
            }
        }
        return $this;
    }
}