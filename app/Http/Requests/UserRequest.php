<?php



namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
{
    $user = User::find($this->segment(3));
    switch($this->method())
    {
        case 'GET':
        case 'DELETE':
        {
            return [];
        }
        case 'POST':
        {
            return [
                 'firstname' => 'required|max:50',
                 'surname' => 'required|max:50',
                'phone' => 'required|max:25',
                'mobile' => 'required|max:25',
                'job_title' => 'required',
                'role_id' => 'required',
                 'email' => 'required|unique:users,email',
                // 'username' => 'required|unique:users,username,{$userId}',
                'password' => 'required|min:6',
            ];
        }
        case 'PUT':
        case 'PATCH':
        {
            return [
                'firstname' => 'required|max:50',
                 'surname' => 'required|max:50',
                'phone' => 'required|max:25',
                'mobile' => 'required|max:25',
                'job_title' => 'required',
              'email' => 'required|unique:users,email,' . $user->id,
                // 'username' => 'required',
            ];
        }
        default:break;
    }
}


}
