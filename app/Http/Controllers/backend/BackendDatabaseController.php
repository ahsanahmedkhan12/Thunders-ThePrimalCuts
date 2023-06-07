<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
class BackendDatabaseController extends Controller
{
    public function backupdatabase(Request $request)
    {    
        // Get the current timestamp for the backup filename
        $timestamp = Carbon::now()->format('YmdHis');

        // Specify the path and filename for the backup file
        $backupFileName = 'backup-' . $timestamp . '.sql';
        $backupFilePath = 'backups/' . $backupFileName;

        // Execute the mysqldump command to create the backup file
        $command = 'mysqldump --user=' . env('DB_USERNAME') . ' --password=' . env('DB_PASSWORD') . ' --host=' . env('DB_HOST') . ' ' . env('DB_DATABASE') . ' > ' . storage_path('app/' . $backupFilePath);
        exec($command);

        // Store the backup file in the desired storage location
        Storage::disk('local')->put($backupFilePath, '');

        // Get the full path to the backup file
        $fullPath = storage_path('app/' . $backupFilePath);

        // Set the appropriate headers for the download response
        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $backupFileName . '"',
        ];

        // Generate a streamed response to download the backup file
        return new StreamedResponse(function () use ($fullPath) {
            $stream = fopen($fullPath, 'rb');

            while (!feof($stream)) {
                echo fread($stream, 1024);
                flush();
            }

            fclose($stream);
        }, 200, $headers);

    } 

    public function restoredatabase(Request $request)
    {    
        return view('back.pages.restore-database');
    } 
    public function restore(Request $request)
    {
        // Validate the request input
        $validator = Validator::make($request->all(), [
            'backup_file' => 'required|file|max:2048', // Adjust the allowed file types and maximum file size as needed
        ]);

        // Check if the validation fails
     
         if ($validator->fails()) {
            $errors = $validator->errors();
             return redirect()->back()->withErrors($errors);
        }
        // Check if the file is present in the request
        if ($request->hasFile('backup_file')) {
            $backupFile = $request->file('backup_file');

            // Get the original filename
            $filename = $backupFile->getClientOriginalName();

            // Specify the path and filename for the backup file
            $backupFilePath = 'backups/' . $filename;

            // Store the backup file in the desired storage location
            Storage::disk('local')->putFileAs('backups', $backupFile, $filename);

            // Get the full path to the backup file
            $fullPath = storage_path('app/' . $backupFilePath);

            // Read the SQL statements from the backup file
            $sqlStatements = file_get_contents($fullPath);

            // Execute the SQL statements to restore the database
            DB::unprepared($sqlStatements);
               return redirect()->back()->with('success', 'Database restore successful');
        }
   
        return redirect()->back()->with('error', 'No backup file provided.');
          
        
    }
}
