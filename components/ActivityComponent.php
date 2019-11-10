<?php


namespace app\components;

use app\models\Activity;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;


class ActivityComponent extends Component
{
    public $modelClass;        //web.php->components->activity
    public function getModel(){
        return new $this->modelClass;
    }

    public function addActivity(Activity $activity): bool //на входе ожидается экземпляр объекта activity и эта функция должна вернуть булево
    {
        $activity->file=UploadedFile::getInstance($activity,'file'); //создаст экземпляр класса UploadedFile со всеми настройками файла который загружен


        if($activity->validate()){
            if($activity->file ){ // если активити есть но чтото с сохранением файла то фалс
                $activity->file = $this->saveFile($activity->file);
                if(!$activity->file) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

  /////// по солид нужно было бы вынести в отдельный компонент работы с файлами
    private function saveFile(UploadedFile $file): ?string {  // ? перед стрингом это значит или стринг вернет или null
        $name=$this->genFileName($file);
        $path=$this->getPathToSave().$name; // + имя загружаемого файла = путь + сгенерированное имя
        if ($file->saveAs($path)){  //перемещение временного файла с новым именем
            return $name;
        }
        return null;
    }

    private function getPathToSave(){
        $path=\Yii::getAlias('@webroot/files/');  //@webroot возвращает абсолютный путь  к папке  web в той машине где он находится
        FileHelper::createDirectory($path); // если папка есть то не создаст
        echo $path;
        return $path;
    }

    private function genFileName(UploadedFile $file) {
        return time()."-".$file->getBaseName().".".$file->getExtension(); //генерация имени файла
    }

}