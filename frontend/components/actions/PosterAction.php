<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/15 0015
 * Time: 下午 13:57
 */

namespace frontend\components\actions;


use common\models\c2\entity\ActivityPlayerModel;
use Da\QrCode\QrCode;
use Imagine\Image\Palette\RGB;
use Imagine\Image\Point;
use Yii;
use yii\base\Action;
use yii\helpers\VarDumper;

class PosterAction extends Action
{
    public function run()
    {
        $this->controller->layout = '/main-empty';
        $param = \Yii::$app->request->get('p');
        $playerModel = ActivityPlayerModel::findOne(['player_code' => $param]);
        // $activityModel = $playerModel->activity;
        // var_dump($playerModel->getMediumStorePath());

        $qrContent = FRONTEND_BASE_URL . '/player/' . $playerModel->player_code;
        $qrCode = (new QrCode($qrContent))
            ->setSize(180)
            ->setMargin(5)
            ->useForegroundColor(00, 00, 00);

        $imgPath = '/poster/' . $playerModel->activity_id . '/' . $playerModel->id . '/';
        $filePath = Yii::getAlias('@appimage') . $imgPath;
        $imageName = $playerModel->player_code . '.png';
        $storePath = $filePath . $imageName;
        if (!file_exists($storePath)) {
            if ($this->create_folders($filePath)) {
                $qrCode->writeFile($storePath); // writer defaults to PNG when none is specified
            }
            $imagine = new \Imagine\Gd\Imagine();
            $watermark = $imagine->open($storePath);
            $bg = $imagine->open(Yii::getAlias('@frontend') . '/web/images/50.png');
            $avatar = $imagine->open($playerModel->getMediumStorePath());

            $size = $bg->getSize();
            $wSize = $watermark->getSize();
            $x = $size->getWidth() / 2 - $wSize->getWidth() / 2;
            // $y = $size->getHeight() - $wSize->getHeight();
            $bottomCenter = new \Imagine\Image\Point($x, 860);
            $bg->paste($watermark, $bottomCenter);

            $fragmentPosition = new \Imagine\Image\Point(202, 212);
            $bg->paste($avatar, $fragmentPosition);

            $palette = new RGB();
            $color = $palette->color("000000");

            $str1 = mb_substr($playerModel->title, 0, 24);
            $point1 = new Point(60, 696);
            $font = $imagine->font(Yii::getAlias('@frontend') . "/web/fonts/simhei.ttf", 20, $color);
            $bg->draw()->text($str1, $font, $point1);

            $str2 = mb_substr($playerModel->title, 24, strlen($playerModel->title));
            $point2 = new Point(60, 740);
            $bg->draw()->text($str2, $font, $point2);

            $bg->save($storePath);
        }
        $imgUrl = IMAGE_BASE_URL . $imgPath . $imageName;

        return $this->controller->render('poster', [
            'imgUrl' => $imgUrl
        ]);
    }

    function create_folders($dir)
    {
        return is_dir($dir) or ($this->create_folders(dirname($dir)) and mkdir($dir, 0777));
    }


}