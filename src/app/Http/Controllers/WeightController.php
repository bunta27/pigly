<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateWeightLogRequest;
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

        return view('admin', compact('target', 'logs', 'latestWeight', 'toGoal'));
    }

    public function show(WeightLog $log)
    {
        return view('weight_logs.detail', compact('log'));
    }

    public function update(UpdateWeightLogRequest $request, WeightLog $log)
    {
        $data = $request->validated();

        [$hour, $minute] = explode(':', $data['exercise_time']);
        $data['exercise_time'] = (int)$hour * 60 + (int)$minute;

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
}
