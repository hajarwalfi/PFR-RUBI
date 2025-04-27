<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SerologyService;
use Illuminate\Http\Request;

class SerologyController extends Controller
{
    protected $serologyService;

    public function __construct(SerologyService $serologyService)
    {
        $this->serologyService = $serologyService;
        $this->middleware('admin');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'donation_id' => 'required|exists:donations,id',
            'tpha' => 'required|string|in:negative,positive,pending',
            'hb' => 'required|string|in:negative,positive,pending',
            'hc' => 'required|string|in:negative,positive,pending',
            'vih' => 'required|string|in:negative,positive,pending',
        ]);

        // Calculate overall result
        $data = $validated;
        $data['result'] = 'negative';
        if (in_array('positive', [$data['tpha'], $data['hb'], $data['hc'], $data['vih']], true)) {
            $data['result'] = 'positive';
        }

        if ($id == 0) {
            $result = $this->serologyService->createSerology($data);
        } else {
            $result = $this->serologyService->updateSerology($id, $data);
        }

        if ($result) {
            return redirect()->back()->with('success', 'Serology updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Error updating serology.')->withInput();
        }
    }
}
