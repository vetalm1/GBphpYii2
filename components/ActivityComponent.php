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
        $activity->files=UploadedFile::getInstances($activity,'files'); //создаст экземпляр класса UploadedFile со всеми настройками файла который загружен /
                                                // буквочку s не забыть приписать чтобы несколько

        $activity->userId=\Yii::$app->user->getIdentity()->id;  // userid присваиваем id текущего аутентифицированного пользователя

        if($activity->validate()){ //когда файлы будем сохранять эта конструкция не сработает нужно ее както обыграть через json
            if($activity->files){ // если активити есть но чтото с сохранением файла то фалс
                $activity->files = $this->saveFile($activity->files);
                if(!$activity->files) {
                    return false;
                }
            }
//            else {
//                $activity->files=null;
//            }

            if($activity->save(false)){ // сохранение в базе в таблице activity
                return true;
            }
            return true;
        }
        return false;
    }

    public function findTodayNotifActivity(){
        return Activity::find()->andWhere('email is not null')
            ->andWhere('dateStart>=:date',[':date' => date('Y-m-d')])
            ->andWhere('dateStart<=:date1',[':date1' => date('Y-m-d').' 23:59:59'])->all();
    }


  /////// по солид нужно было бы вынести в отдельный компонент работы с файлами
//    private function saveFile(UploadedFile $file): ?string {  // ? перед стрингом это значит или стринг вернет или null
//            $name = $this->genFileName($file);
//            $path = $this->getPathToSave() . $name; // + имя загружаемого файла = путь + сгенерированное имя
//            if ($file->saveAs($path)) {  //перемещение временного файла с новым именем
//                return $name;
//            }
//     }  return null;
    private function saveFile($file): ?string {
        $names=[];
        foreach ($file as  $fileItem) {
            $name = 'files/' . $this->genFileName($fileItem);  // почему-то с @webroot не заработало
            $names[] = $this->genFileName($fileItem);
            $fileItem->saveAs($name);
        }
        return $names;
    }

    private function getPathToSave(){
        $path=\Yii::getAlias('@webroot/files/');  //@webroot возвращает абсолютный путь  к папке  web в той машине где он находится
        FileHelper::createDirectory($path); // если папка есть то не создаст и проверять ненужно :)
        return $path;
    }

    private function genFileName(UploadedFile $file) {
        return time()."-".$file->getBaseName().".".$file->getExtension(); //генерация имени файла
    }

}