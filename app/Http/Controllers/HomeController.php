<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Patient;
use App\Models\Dose;
use App\Models\Power;
use App\Models\Medicine;
use Illuminate\Http\Request;
use ZipArchive;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $patient = Patient::query()->latest()->limit(24)->get();
        $totalPatient = Patient::query()->get()->count();
        $todayPatient = Patient::query()->where('created_at', '>=', date('Y-m-d 00:00:00').'%')->count();
        $totalDues = Patient::query()->get()->sum('dues');
        $doses = Dose::get();
        $powers = Power::get();
        $medicines = Medicine::get();
        $diseases = Disease::all();
        return view('welcome',compact(
            'patient',
            'totalPatient',
            'todayPatient',
            'totalDues',
            'doses',
            'powers',
            'medicines',
            'diseases')
        );
    }
    public function medicineByDisease(Request $request)
    {
        $diseases = Disease::query()->whereIn('name', $request->name)->get();
        $data = '';
        foreach ($diseases as $disease){
            foreach ($disease->medicines as $item) {
                $data .= '<option value="' . $item->id . '">' . $item->name . '</option>';
            }

        }
        return $data;
    }
    public function medPrice(Request $request)
    {
        $med = Medicine::query()->findOrFail($request->id);
        $price = $med->mrp_price;

        return response()->json(['price'=>$price]);
    }


    public function backup(){
        // Get connection object and set the charset
        $conn = mysqli_connect('127.0.0.1', 'root', null, 'nhp');
        $conn->set_charset("utf8");

        // Get All Table Names From the Database
        $tables = array();
        $sql = "SHOW TABLES";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }

        $sqlScript = "";
        foreach ($tables as $table) {

            // Prepare SQLscript for creating table structure
            $query = "SHOW CREATE TABLE $table";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);

            $sqlScript .= "\n\n" . $row[1] . ";\n\n";


            $query = "SELECT * FROM $table";
            $result = mysqli_query($conn, $query);

            $columnCount = mysqli_num_fields($result);

            // Prepare SQLscript for dumping data for each table
            for ($i = 0; $i < $columnCount; $i ++) {
                while ($row = mysqli_fetch_row($result)) {
                    $sqlScript .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $columnCount; $j ++) {
                        $row[$j] = $row[$j];

                        if (isset($row[$j])) {
                            $sqlScript .= '"' . $row[$j] . '"';
                        } else {
                            $sqlScript .= '""';
                        }
                        if ($j < ($columnCount - 1)) {
                            $sqlScript .= ',';
                        }
                    }
                    $sqlScript .= ");\n";
                }
            }

            $sqlScript .= "\n";
        }

        if(!empty($sqlScript))
        {
            // Save the SQL script to a backup file
            $backup_file_name = public_path().'/sqlBackup/db_backup_.sql';
            //return $backup_file_name;
            $fileHandler = fopen($backup_file_name, 'w+');
            $number_of_lines = fwrite($fileHandler, $sqlScript);
            fclose($fileHandler);
//
//            $zip = new ZipArchive();
//            $zipFileName = 'sqlBackup/db_backup.zip';
//            $zip->open(public_path() . '/' . $zipFileName, ZipArchive::CREATE);
//            $zip->addFile($backup_file_name, 'sqlBackup/db_backup.sql');
//            $zip->close();

            // Download the SQL backup file to the browser
            /*header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($backup_file_name));
            ob_clean();
            flush();
            readfile($backup_file_name);
            exec('rm ' . $backup_file_name); */
        }
        return redirect()->back()->with('success', 'Database backup done!');
    }
}
