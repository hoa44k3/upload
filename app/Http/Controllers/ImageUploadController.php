<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image; 
use Illuminate\Support\Facades\Session; 
use SimpleQrcode; // Thư viện để tạo mã QR
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class ImageUploadController extends Controller
{
    public function index()
    {
        return view('image.upload'); // Cập nhật đường dẫn view
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|file|max:10240|mimes:jpg,jpeg,png,gif,mp4,mov,avi,wmv', // cho phép tải lên nhiều định dạng
        ]);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public'); // thay đổi thư mục lưu nếu cần
            $type = $file->getClientOriginalExtension();
    
            // Tạo bản ghi trong cơ sở dữ liệu
            Image::create([
                'filename' => basename($path),
                'path' => $path,
                'type' => $type,
            ]);
    
            return response()->json(['success' => 'File uploaded successfully!']);
        }
    
        return response()->json(['error' => 'No file uploaded'], 400);
    }
    
    
    
    public function showClickForm()
    {
        return view('image.click');
    }

    public function showUploadQrForm()
    {
        return view('image.uploadqr');
    }

    public function createQr(Request $request)
    {
        $request->validate([
            'image_url' => 'required|url',
        ]);

        // Tạo mã QR từ URL ảnh
        $qrCodeUrl = QrCode::format('png')->size(200)->generate($request->image_url);
        
        // Lưu URL ảnh và QR code vào session
        Session::flash('qr_code', 'data:image/png;base64,' . base64_encode($qrCodeUrl));
        Session::flash('image_url', $request->image_url);

        return redirect()->back();
    }
}
