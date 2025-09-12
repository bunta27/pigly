<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;

class Modal extends Component
{
    public $open = false;

    public $date;
    public $weight;
    public $calories;
    public $exercise_time = '00:00';
    public $exercise_content;

    protected $listeners = ['openModal' => 'open'];

    protected function rules()
    {
        return [
            'date'             => ['required','date'],
            'weight'           => ['required','numeric','between:0,999.9'],
            'calories'         => ['required','integer','min:0','max:50000'],
            'exercise_time'    => ['required','date_format:H:i'],
            'exercise_content' => ['nullable','string','max:120'],
        ];
    }

    protected $messages = [
        'date.required'             => '日付を入力してください',
        'weight.required'           => '体重を入力してください',
        'calories.required'         => 'カロリーを入力してください',
        'exercise_time.required'    => '運動時間を入力してください',
        'exercise_time.date_format' => '運動時間は「HH:MM」で入力してください',
    ];

    public function mount()
    {
        $this->date = now()->toDateString();
    }

    public function open()
    {
        $this->resetValidation();
        $this->open = true;
    }

    public function close()
    {
        $this->open = false;
    }

    public function save()
    {
        $this->validate();

        [$hour, $minute] = explode(':', $this->exercise_time);
        $time = sprintf('%02d:%02d:00', intval($hour), intval($minute));

        WeightLog::updateOrCreate(
            ['user_id' => Auth::id(), 'date' => $this->date],
            [
                'weight'           => $this->weight,
                'calories'         => $this->calories,
                'exercise_time'    => $time,
                'exercise_content' => $this->exercise_content ?: null,
            ]
        );

        $this->reset(['weight', 'calories', 'exercise_content']);
        $this->exercise_time = '00:00';
        $this->date = now()->toDateString();
        $this->open = false;

        session()->flash('ok', '登録しました');

        return redirect()->route('admin');
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
