<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\PhoneBill;
use App\Models\PhoneBillControl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PhoneBillController extends Controller
{

    public function check_winner()
    {
        $control_bill = PhoneBillControl::find('1');
        $is_contain = PhoneBill::where('user_id',Auth::user()->id)->first();
        $user = User::find(Auth::user()->id);
        if ($is_contain) {
            return response()->json(['error' => 'အကောင့်တစ်ခုလျင်တစ်ကြိမ်သာကံစမ်းခွင့်ရှိပါသည်'], 200);
        } elseif (Auth::user()->ctypto_points == 0) {
            return response()->json(['error' => 'Point မလုံလောက်ပါ'], 200);
        } else {
            $control_bill->count += 1;
            $control_bill->update();
            $user->update([
                'ctypto_points'=>$user->ctypto_points-=1
            ]);
            if ($this->check($control_bill->count) && $control_bill->winner_count < 11) {
                $this->insertHistoryDataBase('winner');
                $control_bill->winner_count += 1;
                $control_bill->update();
                return response()->json(['success' => 'ဖုန်းဘေကံထူးပါသည်။'], 200);
            } else {
                $this->insertHistoryDataBase('lose');
                return response()->json(['error' => 'ကျေးဇူးတင်ပါသည်။နောင်တစ်ကြိမ်ကြမင်းကံကောင်းပါဇီ :-( ။  Hello linker တွင် မြန်မာစာတမ်းထိုးအသစ်စက်စက်ဇတ်ကား များကိုကြည့်ရှုလိုက်ပါ။'], 200);
            }
        }
    }

    public function phone_insert_page()
    {
        $winner = PhoneBill::where('user_id',Auth::user()->id)->where('status','winner')->first();
        if ($winner) {
            if ($winner->phone_number == NULL) {
                return view('user.others.phone_bill');
            }
        }
        return abort(404);
    }

    public function phone_insert(Request $request)
    {
        $request->validate([
            'phone'=>'required',
        ]);
        $winner = PhoneBill::where('user_id',Auth::user()->id)->where('status','winner')->first();
        $winner->update([
            'phone_number'=>$request->phone,
        ]);
        $message = 'ဖုန်းဘေကို '.$request->phone.' ထဲသို့ နှစ်ရက်အတွင်းထည့် ပေးပါမည်။၊<br>Hello Linker မှာ အခမဲ့ အသစ်စက်စက် ဇတ်ကားများကို ကြည့်ရှုလိုက်ပါ';
        return redirect()->route('user#home')->with('success',$message);
    }

    private function check($count)
    {
        if ($count == 1 || $count == 40 ||
            $count == 60 || $count == 80 ||
            $count == 100 || $count == 120 ||
            $count == 140 || $count == 160 ||
            $count == 180 || $count == 200) {
            return true;
        }
        return false;
    }

    private function insertHistoryDataBase($status)
    {
        PhoneBill::create([
            'user_id' => Auth::user()->id,
            'status' => $status,
        ]);
    }
}
