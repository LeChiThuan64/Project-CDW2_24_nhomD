<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChatboxData;
use Illuminate\Http\Request;

class ChatboxController extends Controller
{
    public function index()
    {
        $chatboxData = ChatboxData::all();
        return view('viewAdmin.chatbox_admin', compact('chatboxData'));
    }

    public function updateStatus(Request $request, $id)
    {
        $chatboxData = ChatboxData::findOrFail($id);
        $chatboxData->status = $request->status;
        $chatboxData->save();

        return response()->json(['success' => true, 'updated_at' => $chatboxData->updated_at->format('d/m/Y')]);
    }

    public function saveChatboxData(Request $request)
    {
        try {
            $chatboxData = new ChatboxData();
            $chatboxData->customer_name = $request->customer_name;
            $chatboxData->customer_phone = $request->customer_phone;
            $chatboxData->support_issue = $request->support_issue;
            $chatboxData->detailed_support_content = $request->detailed_support_content;
            $chatboxData->status = 'Chờ hỗ trợ';
            $chatboxData->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $chatboxData = ChatboxData::findOrFail($id);
        $chatboxData->delete();

        return response()->json(['success' => true]);
    }
}