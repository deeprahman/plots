<?php


namespace Plots\Utils;

trait FileUploadTrait
{
    protected function handleUpload(string $uploadDir, $uploadFileName):bool
    {
        $uploadfile = $uploadDir . basename($_FILES[$uploadFileName]['name']);
        if (move_uploaded_file($_FILES[$uploadFileName]['tmp_name'], $uploadfile)) {
            return true;
        } else {
            return false;
        }
    }
}