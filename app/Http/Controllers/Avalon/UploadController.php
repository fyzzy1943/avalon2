<?php

namespace App\Http\Controllers\Avalon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
	protected $files;
	protected $path;
	protected $url;
	protected $name;
	protected $ext;
	protected $randomLength;
	protected $maxSize;
	protected $cover;
	protected $formats;
	protected $errors;

	protected $success;
	protected $message;


    public function __construct()
    {
    	$path = '/beats/' . date('Ymd', time()) . '/';
	    $this->path     =   base_path('/public' . $path);
	    $this->url      =   $path;
	    $this->maxSize  =   4 * 1024;   // 4M
	    $this->cover    =   false;      //不覆盖
	    $this->randomLength =   17;     //文件名长度
	    $this->errors   =   [
		    'empty'      => '上传文件不能为空',
		    'format'     => '上传的文件格式不符合规定',
		    'maxsize'    => '上传的文件太大',
		    'unwritable' => '保存目录不可写，请更改权限',
		    'not_exist'  => '保存目录不存在',
		    'same_file'  => '已经有相同的文件存在',
	    ];
    }

    public function img(Request $request, $name)
    {
        $this->formats  =   [
            'gif', 'jpg', 'jpeg', 'png', 'bmp',
        ];

    	if (!$this->check($name)) {
		    return response()->json([
			    'success'   =>  0,
			    'message'   =>  $this->message,
		    ]);
	    }

		if ($this->store()) {
			return response()->json([
				'success'   =>  1,
				'url'       =>  $this->url . $this->name,
			]);
		} else {
			return response()->json([
				'success'   =>  0,
				'message'   =>  $this->message,
			]);
		}

    }

    protected function check($name)
    {
	    if(empty($_FILES[$name]['name'])) //上传文件为空时
	    {
		    $this->message($this->errors['empty']);
		    return false;
	    }

	    $this->files = $_FILES[$name];

	    if(!file_exists($this->path)) //目录不存在
	    {
	    	mkdir($this->path);
//		    $this->message($this->errors['not_exist']);
//		    return false;
	    }

	    if(!is_writable($this->path)) //目录不可写
	    {
		    $this->message($this->errors['unwritable']);
		    return false;
	    }

	    $this->ext  = $this->getFileExt($this->files["name"]); //取得扩展名

	    $this->name = $this->randomFileName() . '.' . $this->ext;

	    return true;
    }

    protected function store()
    {
	    $files = $this->files;

	    if ($this->formats != "" && !in_array($this->ext, $this->formats))
	    {
		    $formats = implode(',', $this->formats);
		    $message = "您上传的文件" . $files["name"] . "是" . $this->ext . "格式的，系统不允许上传，您只能上传" . $formats . "格式的文件。";
		    $this->message($message);

		    return false;
	    }

	    if ($files["size"] / 1024 > $this->maxSize)
	    {
		    $message = "您上传的 " . $files["name"] . "，文件大小超出了系统限定值" . $this->maxSize . " KB，不能上传。";
		    $this->message($message);

		    return false;
	    }

	    if (!$this->cover) //当不能覆盖时
	    {
		    if(file_exists($this->path.$this->name)) //有相同的文件存在
		    {
			    $this->message($this->name . $this->errors['same_file']);

			    return false;
		    }
	    }

	    if (!@move_uploaded_file($files["tmp_name"], iconv("utf-8", "gbk", $this->path . $this->name)))
	    {
		    switch($files["error"])
		    {
			    case '0':
				    $message = "文件上传成功";
				    break;

			    case '1':
				    $message = "上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值";
				    break;

			    case '2':
				    $message = "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";
				    break;

			    case '3':
				    $message = "文件只有部分被上传";
				    break;

			    case '4':
				    $message = "没有文件被上传";
				    break;

			    case '6':
				    $message = "找不到临时目录";
				    break;

			    case '7':
				    $message = "写文件到硬盘时出错";
				    break;

			    case '8':
				    $message = "某个扩展停止了文件的上传";
				    break;

			    case '999':
			    default:
				    $message = "未知错误，请检查文件是否损坏、是否超大等原因。";
				    break;
		    }

		    $this->message($message);

		    return false;
	    }

	    @unlink($files["tmp_name"]); //删除临时文件

	    return true;
    }

    protected function getFileExt($fileName)
    {
	    return trim(strtolower(substr(strrchr($fileName, '.'), 1)));
    }

    protected function randomFileName()
    {
    	$fileName = '';
	    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
	    $max   = strlen($chars) - 1;
	    mt_srand((double)microtime() * 1000000);

	    for($i = 0; $i < $this->randomLength; $i++)
	    {
		    $fileName .= $chars[mt_rand(0, $max)];
	    }

	    return $fileName;
    }

    protected function message($message, $success = 0)
    {
    	$this->message = $message;
    }

    //
}
