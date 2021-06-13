<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    // USER
    /**
     * Get user Detail
     * @param int $id User ID
     * @return json
     */

    public function show(User $id)
    {
        // Try User find or catch error if any
        try {
            if (!$id) {
                return $this->notfound("User doesnot exist");
            } else {
                return $this->success($id);
            }
        } catch (\Exception $e) {
            return $this->severerror($e->getMessage());
        }
    }

    // USER DELETE
    /**
     * Delete User
     * @param int $id User ID
     * @return json
     */
    public function delete(User $id)
    {
        //if user doesnot exist
        if (!$id) {
            return $this->notfound("User detail not found");
        }
        //check if user exists
        if ($id) {

            //Try user delete or catch error if any
            try {
                $id->delete();
                return $this->success("user Deleted Succesfull");
            } catch (\Exception $e) {
                return $this->severerror($e->getMessage());
            }
        }
    }

    // USER UPDATE
    /**
     * Update User
     * @param int $id User ID
     * @return json
     */
    public function update(Request $request, $id)
    {
        $data = User::find($id);
        $data['password'] = Hash::make($request->password);
        $data->update($request->all());
        // Try user save or catch error if any
        try {
            if ($data) {
            return $this->created("Update Successfully");
            }
        } catch (\Exception $e) {
            return $this->severerror($e->getMessage());
        }
    }
}
