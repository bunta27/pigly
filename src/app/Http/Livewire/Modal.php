<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;

class Modal extends Component
{
    public $date;
    public $weight;
    public $calories;
    public $exercise_time;
    public $exercise_content;

    protected $rules = [
        'date' => ['required,date'],
        'weight' => ['required,numeric,min:0'],
        'calories' => ['required,integer,min:0'],
        'exercise_time' => ['nullable,integer,min:0'],
        'exercise_content' => ['nullable,string,max:120'],
    ];

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
    }

    public function save()
    {
        $this->validate();

        [$hour, $minute] = explode(':', $this->exercise_time ?? '0:0');
        $minutes = ((int) $hour) * 60 + (int)$minute;

        WeightLog::UpdateOrCreate([
            'user_id' => Auth::id(),
            'date' => $this->date,
            'weight' => $this->weight,
            'calories' => $this->calories,
            'exercise_time' => $minutes,
            'exercise_content' => $this->exercise_content,
        ]);

        $this->reset(['weight', 'calories', 'exercise_time', 'exercise_content']);
        $thus->date = now()->format('Y-m-d');
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('logAdded');
        session()->flash('ok', '登録しました');
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
