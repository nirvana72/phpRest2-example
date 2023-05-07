<?php
declare(strict_types=1);

namespace App\Controller;

use PhpRest2\Controller\Attribute\{Controller, Action, Param};

#[Controller('/fileupload')]
class FileUploadController
{
    /***************************************************************************************
     * 由于Request对象封装用的是 Symfony
     * 所以从Request中获取的文件对象，就是symfony/http-foundation 库中的UploadedFile对象
     * see https://github.com/symfony/http-foundation/blob/5.x/File/UploadedFile.php
     **************************************************************************************/
    #[Action('POST:/demo1')]
    #[Param(name: 'file1', bind: 'files.file1', desc: '第一个文件')]
    #[Param(name: 'file2', bind: 'files.file2', desc: '第二个文件')]
    public function demo1($file1, $file2) 
    {
        // $file1 为 UploadedFile 实例
        // $file1->move('/workspace/temp', 'aaa1.txt');
        // $file2->move('/workspace/temp', 'aaa2.txt');
        return [
            'file1' => $file1->getRealPath(),
            'file2' => $file2->getClientOriginalName(),
        ];
    }
}
