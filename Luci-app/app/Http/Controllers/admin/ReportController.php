<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class ReportController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('user')->latest()->get();
        return view('admin.report', compact('feedbacks'));
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('admin.report')->with('success', 'Feedback deleted successfully.');
    }
}
