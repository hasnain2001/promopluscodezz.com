<?php

namespace App\Livewire;

use App\Models\CheckInOut;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class CheckIn extends Component
{

    public $record;

    public function mount()
    {
        $this->record = CheckInOut::where('user_id', Auth::id())
            ->whereDate('created_at', now()->toDateString())
            ->first();
    }

    public function checkIn()
    {
        if (!$this->record || ($this->record->check_out_at && $this->canCheckInAgain()))  {
            $this->record = CheckInOut::create([
                'user_id' => Auth::id(),
                'check_in_at' => now(),
            ]);
        }
    }

    public function checkOut()
    {
        if ($this->record && !$this->record->check_out_at) {
            $this->record->update([
                'check_out_at' => now(),
            ]);
        }
    }
    public function canCheckInAgain()
    {
        if (!$this->record || !$this->record->check_out_at) {
            return false;
        }

        return Carbon::parse($this->record->check_out_at)->addHours(1)->isPast();
    }
    public function render()
    {
        return view('livewire.check-in');
    }
}
