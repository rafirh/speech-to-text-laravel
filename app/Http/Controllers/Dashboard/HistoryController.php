<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHistoryRequest;
use App\Http\Requests\UpdateHistoryRequest;
use App\Models\History;

class HistoryController extends Controller
{
    public function index()
    {
        return view('dashboard.histories.index', [
            'title' => 'History',
            'histories' => History::where('user_id', auth()->user()->id)->latest()->get(),
        ]);
    }

    public function show(History $history)
    {
        if ($history->user_id !== auth()->user()->id) {
            abort(404);
        }

        return view('dashboard.histories.show', [
            'title' => 'History',
            'history' => $history,
        ]);
    }

    public function store(StoreHistoryRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        History::create($data);
        return redirect()->back()->with('success', 'Text has been added to history')->withInput();
    }

    public function edit(History $history)
    {
        if ($history->user_id !== auth()->user()->id) {
            abort(404);
        }

        return view('dashboard.histories.edit', [
            'title' => 'History',
            'history' => $history,
        ]);
    }

    public function update(UpdateHistoryRequest $request, History $history)
    {
        if ($history->user_id !== auth()->user()->id) {
            abort(404);
        }

        $data = $request->validated();
        $history->update($data);
        return redirect($request->previous_url ?? route('dashboard.histories.index'))->with('success', 'Text has been updated');
    }

    public function destroy(History $history)
    {
        if ($history->user_id !== auth()->user()->id) {
            abort(404);
        }

        $history->delete();
        return redirect()->back()->with('success', 'Text has been deleted from history');
    }
}
