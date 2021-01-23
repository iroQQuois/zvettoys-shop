<?php


namespace app\models;


use JetBrains\PhpStorm\Pure;
use phpDocumentor\Reflection\Type;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


class ImageUpload extends Model
{
    public $image;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png,jpeg']
        ];
    }

    /**
     * @param UploadedFile $file
     * @param $currentImage
     * @return string
     */
    public function uploadFile(UploadedFile $file, string|null $currentImage): string
    {
        $this->image = $file;

        if ($this->validate())
        {
            $this->deleteCurrentImage($currentImage);

            return $this->saveImage();
        }
    }

    /**
     * @return string
     */
    private function getFolder(): string
    {
        return Yii::getAlias('@app/web') . '/uploads/';
    }

    /**
     * @return string
     */
    #[Pure] private function generateFilename(): string
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    /**
     * @param string|null $currentImage
     */
    public function deleteCurrentImage(string|null $currentImage): void
    {
        if ($this->fileExists($currentImage) != null)
        {
            unlink($this->getFolder() . $currentImage);
        }
    }

    /**
     * @param string|null $currentImage
     * @return bool|null
     */
    private function fileExists(string|null $currentImage): bool|null
    {
        if (!empty($currentImage) && $currentImage != null)
        {
            return file_exists($this->getFolder() . $currentImage);
        }
    }

    /**
     * @return string
     */
    private function saveImage(): string
    {
        $filename = $this->generateFilename();

        $this->image->saveAs($this->getFolder() . $filename);

        return $filename;
    }
}