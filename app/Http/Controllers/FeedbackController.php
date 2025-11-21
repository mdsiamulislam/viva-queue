<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{

    public function index()
    {

        $feedbacks = DB::table('feedback')->get();
        return view('feedback.index', ['feedbacks' => $feedbacks]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'roll' => 'required|integer',
            'phone' => 'required|integer',
            'email' => 'nullable|email',
            'problem_type' => 'required|string|max:255',
            'problem_details' => 'required|string',
            'solution_proposal' => 'nullable|string',
            'is_anonymous' => 'boolean',
        ]);

        $id = DB::table('feedback')->insertGetId([
            'name' => $request->input('name'),
            'roll' => $request->input('roll'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'problem_type' => $request->input('problem_type'),
            'problem_details' => $request->input('problem_details'),
            'solution_proposal' => $request->input('solution_proposal'),
            'is_anonymous' => $request->has('is_anonymous'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create tracking ID
        $trackingId = 'iomfeedback' . $id;

        return redirect()->route('feedback.track', ['trackingId' => $trackingId])
            ->with('success', 'Feedback submitted successfully! Your Tracking ID is: ' . $trackingId);
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'solution_status' => 'required|string|max:255',
            'solution_from_admin' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        DB::table('feedback')
            ->where('id', $id)
            ->update([
                'solution_status' => $request->input('solution_status'),
                'solution_from_admin' => $request->input('solution_from_admin'),
                'remarks' => $request->input('remarks'),
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Feedback updated successfully.');
    }

    // Edit feedback - show edit form
    public function edit($id)
    {
        $feedback = DB::table('feedback')->where('id', $id)->first();
        return view('feedback.admin_feedback_edit', ['feedback' => $feedback]);
    }

    public function track($trackingId)
    {
        // Extract numeric ID
        $id = (int) filter_var($trackingId, FILTER_SANITIZE_NUMBER_INT);

        $feedback = DB::table('feedback')->where('id', $id)->first();

        if (!$feedback) {
            abort(404, "Feedback not found");
        }

        return view('feedback.track', [
            'feedback' => $feedback,
            'trackingId' => $trackingId
        ]);
    }

    // Delete all feedback entries (for admin use)
    public function deleteAll()
    {
        DB::table('feedback')->delete();
        return redirect('/');
    }
}
