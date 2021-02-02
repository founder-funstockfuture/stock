<?php

namespace App\Handlers;

use Image;
use Str;
use Illuminate\Support\Facades\Storage;


class ImageUploadS3Handler
{
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        // 構建存儲的文件夾規則，值如：uploads/images/avatars/201709/21/
        // 文件夾切割能讓查找效率更高。
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        // 文件具體存儲的物理路徑，`public_path()` 獲取的是 `public` 文件夾的物理路徑。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        //$upload_path = public_path() . '/' . $folder_name;

        // 獲取文件的後綴名，因圖片從剪貼板裏黏貼時後綴名爲空，所以此處確保後綴一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名，加前綴是爲了增加辨析度，前綴可以是相關數據模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        //$filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        // 如果上傳的不是圖片將終止操作
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // 裁剪圖片
        if ($max_width && $extension != 'gif') {

            $this->reduceSize($file, $max_width);
        }

        // 加入浮水印
        //$this->watermark($file);


        // 將圖片上傳到 S3
        $path = Storage::disk('s3')->put($folder_name, $file);



        //\Debugbar::info('https://funstockfuture-test-bucket.s3-ap-northeast-1.amazonaws.com/'.$path);
        return [
            //'path' => config('app.url') . "/$folder_name/$filename"
            'path' => 'https://funstockfuture-test-bucket.s3-ap-northeast-1.amazonaws.com/'.$path
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        // 先實例化，傳參是文件的磁盤物理路徑
        $image = Image::make($file_path);

        // 進行大小調整的操作
        $image->resize($max_width, null, function ($constraint) {

            // 設定寬度是 $max_width，高度等比例縮放
            $constraint->aspectRatio();

            // 防止裁圖時圖片尺寸變大
            $constraint->upsize();
        });

        // 對圖片修改後進行保存
        $image->save();
    }

    public function watermark($file_path, $position = 'center')
    {
        $image = Image::make($file_path);

        $watermark = Image::make('https://d1yjjnpx0p53s8.cloudfront.net/styles/logo-thumbnail/s3/042018/untitled-2_73.png');

        $image->insert($watermark, $position);

        // 對圖片修改後進行保存
        $image->save();
    }



}