<?php


namespace App\Libs;


class UploadImage
{

    private $errors = false;

    public function __construct(string $name, int $size, string $tmpName, string $type)
    {
        $this->uploadImage($name, $size, $tmpName, $type);
    }


    public function uploadImage(string $name, int $size, string $tmpName, string $type)
    {
        $currentDir = getcwd();
        $uploadDirectory = "/uploads/posts/";

        $fileExtensions = ['jpeg','jpg','png'];

        $fileName = $name;
        $fileSize = $size;
        $fileTmpName  = $tmpName;
        $fileType = $type;
        $fileExtension = strtolower(end(explode('.',$fileName)));

        $uploadPath = $currentDir . $uploadDirectory . basename($fileName);

        if (!in_array($fileExtension,$fileExtensions)) {
            $this->errors = "L'extension du fichier n'est pas autorisée. Veuillez télécharger un fichier JPEG ou PNG";
        }

        if ($fileSize > 2000000) {
            $this->errors = "Ce fichier fait plus de 2 Mo. Désolé, il doit être inférieur ou égal à 2 Mo";
        }

        if (empty($this->errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                return basename($fileName);
            } else {
                $this->errors = "Une erreur s'est produite quelque part. Réessayez ou contactez l'administrateur";
            }
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
