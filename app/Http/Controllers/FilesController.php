<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Files;
use App\Mission;

use Illuminate\Support\Facades\Storage;
use App\Helper\Util;
class FilesController extends Controller
{
    use Util;
    // 文件上传方法
    public function upload(Request $request)
    {
        if ($request->isMethod('post')) {
            $file = $request->file('file');
            // 文件是否上传成功
            if ($file->isValid()) {
                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $ext = "save";
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg
                // 上传文件
                $uuid = uniqid();
                $filename = date('Y-m') . '/' . $uuid . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                //这里的uploads是配置文件的名称
                Storage::disk('uploads')->makeDirectory(date('Y-m'));
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                $save_file = new Files;
                $save_file->uuid=$uuid;
                $save_file->originalename=$originalName;
                $save_file->filepath=$filename;
                $save_file->save();
            }
        }
//        return response()->json(['err' => 0, 'data' => $uuid]);
        return redirect('files');
    }
    public function download($uuid){
        $file = Files::where('uuid', $uuid)->firstOrFail();
        $filepath = Storage::disk('uploads')->path($file->filepath);
        return response()->download($filepath, $file->originalename);
    }
    public function index(Request $request){
        $files  = Files::paginate($this->pageNumber());
        return view('files.index',compact('files'));
    }
    public function delete($uuid){
        $mission = Mission::where("file_uuid",$uuid)->get();
        if($mission->count()>0){
            return redirect('files');
        }
        $file = Files::where("uuid",$uuid)->firstOrFail();
        if($file->filepath)
            Storage::disk('uploads')->delete($file->filepath);
        $file->delete();
        return redirect('files');
    }
}
