<?php


namespace shfretak\lib;


class FileDownload
{
    public string $fileName;
    public string $filePath;
    public string $file;
    public float $fileSize;

    /**
     * FileDownload constructor.
     * @param string $fileName
     * @param string $filePath
     */
    public function __construct(string $fileName, string $filePath)
    {
        $this->fileName = $fileName;
        $this->filePath = $filePath;
        $this->file = $filePath . $fileName;
        $this->fileSize = filesize($this->file);
        if (file_exists($this->file)) {
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=" . $this->fileName);
            header("Expires: 0");
            header("Pragma: public");
            header("Content-Length: ". $this->fileSize);
            readfile($this->file);
            return true;
        }
        return false;
    }


}