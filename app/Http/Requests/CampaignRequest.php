<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Campaign;

class CampaignRequest extends FormRequest
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
        $campaign = Campaign::find($this->campaigns);
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
                 'account_id' => 'required',
                 'campaign_no' => 'required',
                 'campaign' => 'required',
                'performance_dashboard' => 'required',
                'insight_dashboard' => 'required',
                'internal_dashboard' => 'required',
                 // 'sales_developer' => 'required',
                // 'sales_developer_2' => 'required',
                // 'sales_developer_3' => 'required',
                // 'sales_developer_4' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'status' => 'required',
                'primary_contact' => 'required',
            ];
        }
        case 'PUT':
        case 'PATCH':
        {
            return [
                'account_id' => 'required',
               'campaign_no' => 'required',
                 'campaign' => 'required',
                'performance_dashboard' => 'required',
                'insight_dashboard' => 'required',
                'internal_dashboard' => 'required',
                // 'sales_developer_1' => 'required',
                // 'sales_developer_2' => 'required',
                // 'sales_developer_3' => 'required',
                // 'sales_developer_4' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'status' => 'required',
                'primary_contact' => 'required',
            ];
        }
        default:break;
    }
    }
}
