<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Pets;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class HomeController extends Controller
{

    // Trả về view 'User.home'
    public function index()
    {
        $sp = Pets::all();
        $accessories = Pets::where('species', 'phụ kiện')->paginate(8);
        // Lấy 10 vật nuôi mới nhất
        // $sp = Pets::orderBy('updated_at', 'desc')->take(10)->get();
        // Lấy 10 vật nuôi mới nhất dựa trên created_at hoặc updated_at
        $spm = Pets::orderBy('created_at', 'desc')->take(4)->get();
        // Lấy tất cả danh mục
        $lsp = Category::all();
        // Lấy 6 sản phẩm bán chạy nhất
        $sellingProducts = Pets::orderBy('quantity_sold', 'desc')->take(4)->get();
        // Lấy danh sách chó và mèo ngẫu nhiên (giả sử species là 'chó' hoặc 'mèo')
        $randomPets = Pets::whereIn('species', ['chó', 'mèo'])->inRandomOrder()->take(8)->get();
        // Trả về view với các biến dữ liệu
        return view('User.home', compact('lsp', 'sp', 'accessories', 'spm', 'sellingProducts', 'randomPets'));
    }

    // Trả về view 'User.contact'
    public function contact()
    {
        $sp = Pets::all();
        $lsp = Category::all();
        return view('User.contact', compact('lsp', 'sp')); // Sử dụng đường dẫn chính xác
    }


    // Trả về view 'User.introduction'
    public function introduction()
    {
        $sp = Pets::all();
        $lsp = Category::all();
        return view('User.introduction', compact('lsp', 'sp')); // Sử dụng đường dẫn chính xác
    }


    public function category($hashed_category)
    {
        $category_id = Hashids::decode($hashed_category)[0];
        // Kiểm tra nếu không giải mã được ID, thì trả về 404
        if (!$category_id) {
            abort(404);
        }
        // Lấy thông tin danh mục hiện tại
        $loaisp = Category::where('category_id', $category_id)->first();
        // Kiểm tra nếu không tìm thấy danh mục
        if (!$loaisp) {
            abort(404);
        }
        $product = Pets::where('category_id', $category_id)->get();
        $lsp = Category::all();
        $lsp = DB::table('Categories') // Bắt đầu từ bảng 'Categories'
            ->leftJoin('Pets', 'Categories.category_id', '=', 'Pets.category_id') // Kết hợp bảng 'Pets' với bảng 'Categories' thông qua 'category_id'
            ->selectRaw('Categories.category_id, Categories.category_name, COUNT(Pets.pet_id) as pets_count')
            // Chọn cột 'category_id' và 'category_name' từ bảng 'Categories' và đếm số lượng pet_id từ bảng 'Pets', đặt tên cho cột đếm là 'pets_count'
            ->groupBy('Categories.category_id', 'Categories.category_name') // Nhóm theo cột 'category_id' và 'category_name' của bảng 'Categories'
            ->get();
        $sp = Pets::all();
        return view('User.category', compact('product', 'lsp', 'sp', 'loaisp'));
    }

    // Trả về view 'User.detail'
    public function detail($pet_id)
    {
        // Lấy thông tin pet dựa trên pet_id
        $sp = DB::table('Pets')->where('pet_id', $pet_id)->first();
        // Nếu không tìm thấy pet
        if (!$sp) {
            return redirect()->back()->with('error', 'Pet not found.');
        }
        // Lấy danh sách danh mục
        $lsp = DB::table('Categories')
            ->leftJoin('Pets', 'Categories.category_id', '=', 'Pets.category_id')
            ->selectRaw('Categories.category_id, Categories.category_name, COUNT(Pets.pet_id) as pets_count')
            ->groupBy('Categories.category_id', 'Categories.category_name')
            ->get();
        // Lấy danh sách thú cưng tương tự
        $similarProducts = DB::table('Pets')
            ->where('category_id', $sp->category_id)
            ->where('pet_id', '!=', $pet_id)
            ->get();
        // Trả về view
        return view('User.detail', compact('lsp', 'sp', 'similarProducts'));
    }

    // Trả về view 'User.product'
    public function products()
    {
        $pets = Pets::whereIn('species', ['chó', 'mèo'])->paginate(12);
        $lsp = Category::all();
        $lsp = DB::table('Categories') // Bắt đầu từ bảng 'Categories'
            ->leftJoin('Pets', 'Categories.category_id', '=', 'Pets.category_id') // Kết hợp bảng 'Pets' với bảng 'Categories' thông qua 'category_id'
            ->selectRaw('Categories.category_id, Categories.category_name, COUNT(Pets.pet_id) as pets_count')
            // Chọn cột 'category_id' và 'category_name' từ bảng 'Categories' và đếm số lượng pet_id từ bảng 'Pets', đặt tên cho cột đếm là 'pets_count'
            ->groupBy('Categories.category_id', 'Categories.category_name') // Nhóm theo cột 'category_id' và 'category_name' của bảng 'Categories'
            ->get(); // Lấy tất cả các kết quả đã truy vấn
        return view('User.products', compact('lsp', 'pets')); // Sử dụng đường dẫn chính xác
    }


    // Trả về view 'User.accessory'
    public function accessory()
    {
        $accessories = Pets::where('species', 'phụ kiện')->paginate(9);
        $lsp = Category::all();
        $lsp = DB::table('Categories') // Bắt đầu từ bảng 'Categories'
            ->leftJoin('Pets', 'Categories.category_id', '=', 'Pets.category_id') // Kết hợp bảng 'Pets' với bảng 'Categories' thông qua 'category_id'
            ->selectRaw('Categories.category_id, Categories.category_name, COUNT(Pets.pet_id) as pets_count')
            // Chọn cột 'category_id' và 'category_name' từ bảng 'Categories' và đếm số lượng pet_id từ bảng 'Pets', đặt tên cho cột đếm là 'pets_count'
            ->groupBy('Categories.category_id', 'Categories.category_name') // Nhóm theo cột 'category_id' và 'category_name' của bảng 'Categories'
            ->get(); // Lấy tất cả các kết quả đã truy vấn
        return view('User.accessory', compact('lsp', 'accessories')); // Sử dụng đường dẫn chính xác
    }
    // Trả về view 'User.service'
    public function service()
    {
        $sp = Pets::all();
        $lsp = Category::all();
        $services = Service::all();
        return view('User.service', compact('lsp', 'sp', 'services')); // Sử dụng đường dẫn chính xác
    }
    // Trả về view 'User.search'
    public function search(Request $request)
    {
        $sp = Pets::all();
        $lsp = Category::all();
        $key = $request->key;
        $pets = Pets::where('species', 'like', '%' . $key . '%')
            ->orWhere('description', 'like', '%' . $key . '%');
        // Nếu giá trị tìm kiếm là một số, thêm điều kiện tìm kiếm theo giá
        if (is_numeric($key)) {
            $pets = $pets->orWhere('price', $key)
                ->orWhere('pet_id', $key);
        }
        $pets = $pets->get();
        $lsp = DB::table('Categories') // Bắt đầu từ bảng 'Categories'
            ->leftJoin('Pets', 'Categories.category_id', '=', 'Pets.category_id') // Kết hợp bảng 'Pets' với bảng 'Categories' thông qua 'category_id'
            ->selectRaw('Categories.category_id, Categories.category_name, COUNT(Pets.pet_id) as pets_count')
            // Chọn cột 'category_id' và 'category_name' từ bảng 'Categories' và đếm số lượng pet_id từ bảng 'Pets', đặt tên cho cột đếm là 'pets_count'
            ->groupBy('Categories.category_id', 'Categories.category_name') // Nhóm theo cột 'category_id' và 'category_name' của bảng 'Categories'
            ->get(); // Lấy tất cả các kết quả đã truy vấn
        return view('User.search', compact('lsp', 'sp', 'pets')); // Sử dụng đường dẫn chính xác
    }
    // Trả về view 'User.cart'
    public function cart(Request $request)
    {
        $sp = Pets::all();
        $lsp = Category::all();
        $cart = $request->session()->get('Cart');
        return view('User.cart', compact('lsp', 'sp', 'cart')); // Sử dụng đường dẫn chính xác
    }
    public function checkouts(Request $request)
    {
        $sp = Pets::all();
        $lsp = Category::all();
        $cart = $request->session()->get('Cart');
        return view('User.cart', compact('lsp', 'sp', 'cart')); // Sử dụng đường dẫn chính xác
    }
    public function historical()
    {
        $lsp = Category::all();
        return view('User.orders.historical', compact('lsp'));
    }
    public function guarantee()
    {
        $lsp = Category::all();
        return view('User.orders.guarantee', compact('lsp'));
    }
}
