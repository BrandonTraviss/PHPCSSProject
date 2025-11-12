<?php
class FileHandler
{
    public function saveImage(array $fileData, string $fileExt)
    {
        $newFileName = uniqid('', true) . '.' . $fileExt;
        $destination = 'upload/' . $newFileName;

        if (move_uploaded_file($fileData['tmp_name'], $destination)) {
            return $destination;
        }

        return false;
    }
        public function deleteImage(string $imgLink)
    {
            if (file_exists($imgLink)) {
                return unlink($imgLink);
            }
        return false;
    }
}
