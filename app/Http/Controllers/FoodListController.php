<?php

namespace App\Http\Controllers;

use App\Response\BaseResponse;
use App\Models\FoodList;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FoodListController extends Controller
{
    public function index()
    {
        $foodlist = FoodList::all();
        return BaseResponse::success(data: $foodlist, statuscode: Response::HTTP_OK);
    }

    public function show($id)
    {
        $foodbyId = FoodList::where('FoodListId', (int)$id)->first();

        if (!$foodbyId) {
            return BaseResponse::error("Food not found", statusCode: Response::HTTP_NOT_FOUND);
        }

        return BaseResponse::success($foodbyId, "Food found successfully", statuscode: Response::HTTP_OK);
    }


    public function search($keyword)
    {
       // Tìm kiếm trong các trường FoodName, UploadImage và Description
        $foodlist = FoodList::where([
            '$or' => [
                ['FoodName' => ['$regex' => $keyword, '$options' => 'i']],
                ['UploadImage' => ['$regex' => $keyword, '$options' => 'i']],
                ['Description' => ['$regex' => $keyword, '$options' => 'i']]
            ]
        ])
        ->get()
        ->toArray();

        return BaseResponse::success($foodlist, "Search successfully", statuscode: Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Tạo một bản ghi mới của FoodList và gán các giá trị từ request
        $newFood = new FoodList();
        $newFood->FoodListId = $request->FoodListId;
        $newFood->CategoryId = $request->CategoryId;
        $newFood->FoodName = $request->FoodName;
        $newFood->Price = $request->Price;
        $newFood->qty = $request->qty;
        $newFood->UploadImage = $request->UploadImage;
        $newFood->Description = $request->Description;
        $newFood->UserId = $request->UserId;
        $newFood->Status = $request->Status;
        $newFood->IsNew = $request->IsNew;
        $newFood->IsNoiBat = $request->IsNoiBat;
        $newFood->QuantitySupplied = $request->QuantitySupplied;
        $newFood->Qtycontrolled = $request->Qtycontrolled;
        $newFood->QtySuppliedcontrolled = $request->QtySuppliedcontrolled;
    
        // Lưu bản ghi mới vào cơ sở dữ liệu
        $newFood->save();
    
        // Trả về phản hồi thành công và FoodListId của bản ghi mới được tạo
        return BaseResponse::success(['FoodListId' => $newFood->id], "Food created successfully", statuscode: Response::HTTP_CREATED);
    }
    public function update(Request $request)
    {
        // Find the document by FoodListId
        $foodbyId = FoodList::where('FoodListId', (int)$request->FoodListId)->first();
        
        // Check if the document exists
        if(!$foodbyId){
            return BaseResponse::success(null, "Food Not Found", statuscode: Response::HTTP_OK);
        }
        
        // Update the document with the new values directly from the request object
        $foodbyId->update($request->all());
    
        // Save the updated document
        $foodbyId->save();
        
        // Return the updated document as response
        return BaseResponse::success($foodbyId, "Food updated successfully", statuscode: Response::HTTP_OK);
    }
    


    public function destroy($id)
    {
        $foodbyId = FoodList::where('FoodListId', (int)$id)->first();
        if(!$foodbyId){
            return BaseResponse::success(null, "Food Not Found", statuscode: Response::HTTP_OK);
        }
        $foodbyId->delete();
        return BaseResponse::success(null, "Food deleted successfully", statuscode: Response::HTTP_OK);
    }
}
