<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateWeightLogRequest;
use App\Http\Requests\WeightTargetRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $target = WeightTarget::firstOrCreate(
            ['user_id' => $user->id],
            ['target_weight' => 45.0]
        );

        $weightLogsQuery = WeightLog::where('user_id', $user->id);

        if ($request->filled('from')) {
        $weightLogsQuery->whereDate('date', '>=', $request->date('from'));
        }
        if ($request->filled('to')) {
        $weightLogsQuery->whereDate('date', '<=', $request->date('to'));
        }

        $count = (clone $weightLogsQuery)->count();

        $logs = $weightLogsQuery
        ->orderBy('date', 'desc')
        ->paginate(8)
        ->withQueryString();

        $latestLog = WeightLog::where('user_id', $user->id)
        ->orderBy('date', 'desc')
        ->first();

        $latestWeight = $latestLog?->weight;

        $toGoal = $latestWeight !== null
        ? round($target->target_weight - $latestWeight, 1)
        : null;

        $from = $request->input('from');
        $to = $request->input('to');

        return view('admin', compact('target', 'logs', 'latestWeight', 'toGoal', 'count', 'from', 'to'));
    }

    public function show(WeightLog $log)
    {
        return view('detail', compact('log'));
    }

    public function update(UpdateWeightLogRequest $request, WeightLog $log)
    {
        $data = $request->validated();

        $time = $data['exercise_time'] ?? null;

        if (filled($time)) {
            [$hour, $minute] = explode(':', $time);
            $data['exercise_time'] = sprintf('%02d:%02d:00', (int)$hour, (int)$minute);
        } else {
            $data['exercise_time'] = '00:00:00';
        }

        $log->update([
            'date'             => $data['date'],
            'weight'           => $data['weight'],
            'calories'         => $data['calories'],
            'exercise_time'    => $data['exercise_time'],
            'exercise_content' => $data['exercise_content'] ?? null,
        ]);

        return redirect()->route('admin')->with('ok', '登録しました');
    }

    public function destroy(WeightLog $log)
    {
        $log->delete();
        return redirect()->route('admin')->with('ok', '削除しました');
    }

    public function editTarget(Request $request)
    {
        $user = $request->user();
        $target = WeightTarget::firstOrCreate(
            ['user_id' => $user->id],
            ['target_weight' => 45.0]
        );

        return view('model', compact('target'));
    }

    public function updateTarget(Request $request)
    {
        $data = $request->validate(
            ['target_weight' => ['required','numeric','max:999.9','regex:/^\d{1,4}(\.\d)?$/'],],
            ['target_weight.required' => '目標の体重を入力してください',
            'target_weight.numeric'  => '4桁までの数字で入力してください',
            'target_weight.max'  => '4桁までの数字で入力してください',
            'target_weight.regex'  => '小数点は1桁で入力してください',]
        );

        $request->user()->weightTarget()->updateOrCreate(
            ['user_id' => $request->user()->id],
            ['target_weight' => $data['target_weight']]
        );

        return redirect()->route('admin')->with('ok', '目標体重を更新しました');
    }

}
