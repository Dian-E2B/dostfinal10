<?php

namespace App\Http\Controllers;

use App\Models\EmailContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailSaveController extends Controller
{

    public function upload(Request $request)
    {
        //        if($request->hasFile('upload')) {
        //            $originName = $request->file('upload')->getClientOriginalName();
        //            $fileName = pathinfo($originName,PATHINFO_FILENAME);
        //            $extension = $request->file('upload')->getClientOriginalExtension();
        //            $fileName = $fileName . '_' . time() . '.' . $extension;
        //            $request->file('upload')->move(public_path('media'), $fileName);
        //
        //            $url = asset('media/' . $fileName);
        //            return response()->json(['fileName'
        //            => $fileName, 'uploaded'=> 1, 'url'=> $url]);
        //
        //
        //        }
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('media'), $fileName);

            // Get the base URL of your application (e.g., https://example.com)
            $baseUrl = url('/');

            // Construct the absolute URL to the uploaded image
            $url = 'media/' . $fileName;

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function create(Request $request)
    {

        try {
            $emailcontent101 = $request->input('content');


            $this->validate($request, [
                'content' => 'required',
            ]);



            $emailContent = EmailContent::find(1); // Find the record with ID 1
            $rowsemail = DB::table('emailcontent')
                ->select([
                    DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(content, 'Date: [', -1), ']', 1) as date"),
                    DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(content, 'Time: [', -1), ']', 1) as time"),
                    DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(content, 'Zoom Link/Venue: [', -1), ']', 1) as zoom"),
                    DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX(content, 'Venue: [', -1), ']', 1) as venue"),
                ])
                ->get();

            if ($emailContent) {

                $emailContent->thisdate = $rowsemail[0]->date;
                $emailContent->venue = $rowsemail[0]->venue;
                $emailContent->time = $rowsemail[0]->time;
                $emailContent->save(); // Save the updated record

            } else {
                // If the record with ID 1 doesn't exist, create a new one
                EmailContent::create([
                    'id' => 1, // Set the 'id' attribute
                    'content' => $emailcontent101, // Set the 'content' attribute
                    'updated_at' => now(), // Set the 'updated_at' attribute
                    'thisdate' => $rowsemail[0]->date,
                    'venue' => $rowsemail[0]->venue,
                    'time' => $rowsemail[0]->time,
                ]);
            }

            //            flash()->addSuccess('email content saved successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            // Log the error or return an error response
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
