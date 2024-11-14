<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BankAccountController extends Controller
{
    public function store(Request $request)
    {
        $user_id = Auth::id();
        if (!$user_id) {
            return response()->json(['error' => 'Bạn phải đăng nhập để thực hiện hành động này.'], 401);
        }
        try {
            $bankAccount = BankAccount::create([
                'user_id' => $user_id,
                'bank_name' => $request->bank_name,
                'card_number' => $request->card_number,
                'card_holder_name' => $request->card_holder_name,
                'issue_date' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->issue_date)->format('Y-m-d'),
                'expiry_date' => $request->expiry_date,
            ]);
            
            return response()->json(['success' => 'Thông tin tài khoản ngân hàng đã được lưu.']);
        } catch (\Exception $e) {
            Log::error('Error saving bank account: ' . $e->getMessage());
            return response()->json(['error' => 'Đã xảy ra lỗi khi lưu thông tin tài khoản ngân hàng.', 'details' => $e->getMessage()], 500);
        }
    }
}