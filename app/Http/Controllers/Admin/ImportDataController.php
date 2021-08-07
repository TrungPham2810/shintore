<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recusive;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportDataController extends Controller
{
    protected $product;
    protected $recusive;

    public function __construct(
        Product $product,
        Recusive $recusive
    ) {
        $this->product = $product;
        $this->recusive = $recusive;
    }

    public function index()
    {
//        $this->renderData();
//        die();
        return view('admin.importdata.form');
    }

    public function importData(Request $request)
    {
        if ($_FILES["import_data"]["name"]) {
            $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
            if(in_array($_FILES['import_data']['type'],$mimes)){
                $source = $_FILES["import_data"]["tmp_name"];
                $errors = $this->import($source);
//                die();
                if ($errors) {
                    return redirect()->route('admin.importdata.index')->with('message', implode(' ', $errors));
                } else {
                    return redirect()->route('admin.importdata.index')->with('message', 'Import data success');
                }
            } else {
                return redirect()->route('admin.importdata.index')->with('message', "Sorry, mime type not allowed");
            }
        }
    }

    public function import($fileName)
    {
        $error = [];
        $fp = fopen($fileName, 'r');
        if (!$fp) {
            $error[] = __('Can not open file %s .', $fileName);
            return $error;
        }
        $currLineNum = 0;
        $table = '';
        $tableField = [];
        while (($line = fgetcsv($fp, 30000, ',', '"')) !== false) {
            $currLineNum++;
            for ($i = 0; $i < count($line); $i++) {
                $line[$i] = trim(str_replace(["\r", "\n", "\t", "\\", '"', "'", "*"], '', $line[$i]));
            }
            // Skip header name, and line have 1 element
            if ( in_array($currLineNum, [1, 2]) || count($line) < 10) {
                if($currLineNum == 1) {
                    $table = $line[1];
                }
                if($currLineNum == 2) {
                    foreach($line as $field) {
                        $tableField[] = $field;
                    }
                }
                continue;
            }
            foreach ($line as $key=> $value) {
                $line[$key] = trim($value);
            }
//            var_dump($table);
//            var_dump($tableField);
            $dataInsert = [
                'name' => $line[0],
                'url_key' => $line[1],
                'sku' => $line[2],
                'qty' => $line[3],
                'category_id' => $line[4],
                'image_name' => $line[5],
                'image_path' => $line[6],
                'description' => $line[7],
                'price' => $line[8],
                'import_price' => $line[9],
                'state' => $line[10],
            ];

            try {
                DB::beginTransaction();
                if($tableField && $table) {
                    if ($line[0] != '' && $line[1] != '' && $line[2] != ''&& $line[4] != ''&& $line[5] != ''&& $line[6] != ''&& $line[8] != ''&& $line[9] != ''&& $line[10] != '') {
//                        $insertString = '[';
//                        $insertString .= '"'.$tableField[0].'" => "'.$line[0].'", ';
//                        $insertString .= '"'.$tableField[1].'" => "'.$line[1].'", ';
//                        $insertString .= '"'.$tableField[2].'" => "'.$line[2].'", ';
//                        $insertString .= '"'.$tableField[3].'" => "'.$line[3].'", ';
//                        $insertString .= '"'.$tableField[4].'" => "'.$line[4].'", ';
//                        $insertString .= '"'.$tableField[5].'" => "'.$line[5].'", ';
//                        $insertString .= '"'.$tableField[6].'" => "'.$line[6].'", ';
//                        $insertString .= '"'.$tableField[7].'" => "'.$line[7].'", ';
//                        $insertString .= '"'.$tableField[8].'" => "'.$line[8].'", ';
//                        $insertString .= '"'.$tableField[9].'" => "'.$line[9].'", ';
//                        $insertString .= '"'.$tableField[10].'" => "'.$line[10].'", ';
//                        $insertString .= '],';
//                        echo $insertString;
//                        echo "<br/>";
                    $product = $this->product->create($dataInsert);
                    }
                } else {
                    Log::error('Can\'t found table and table field to import data.');
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $message = 'Error: ' . $e->getMessage();
                Log::error($message. ' Line: '.$e->getLine());
                $error[] = $message. ' Line: '.$e->getLine();
            }//end while
        } //end while
        fclose($fp);
        return $error;
    }

    public function renderData()
    {
        $titles = [
            'Snoopy'=>'snoopy',
            'StarBucks' => 'starbucks',
            'Maruko' => 'maruko',
            'Shin' => 'shin',
            'Rubik' => 'rubik',
            'Xếp Hình' => 'xep-hinh',
            'Hug Me' => 'hug-me',
            'Khủng Long' => 'khung-long',
            'WaterColor Hồng Trắng' => 'watercolor-hong-trang',
            'WaterColor Hồng Sen' => 'watercolor-hong-sen',
            'WaterColor Xanh Rêu' => 'watercolor-xanh-reu',
            'WaterColor Xanh Mint' => 'watercolor-xanh-mint',
            'WaterColor Xanh Dương' => 'watercolor-xanh-duong',
            'Kính Chống Nhìn Trộm' => 'kinh-cnt',
            'Kính King Kong' => 'kinh-king-kong',
            'Kính 9D' => 'kinh-9d',
            'Kính 10D' => 'kinh-10d',
            'Kính Tê Giác' => 'kinh-te-giac',
            'Kính Thường' => 'kinh-thuong',
        ];
        $titleTypeIphone = [
            '- 7/8 Plus',
            '- X/XS',
            '- XR',
            '- XsMax',
            '- 11',
            '- 11Pro',
            '- 11Promax',
            '- 12',
            '- 12Pro',
            '- 12Promax',
        ];

        $skuTypeIphone = [
            '-7-8-plus',
            '-x-xs',
            '-xr',
            '-xs-max',
            '-11',
            '-11pro',
            '-11promax',
            '-12',
            '-12pro',
            '-12promax',
        ];

        foreach($titles as $title => $sku) {
            foreach ($titleTypeIphone as $titleType) {
                if(strpos($title,'Kính') !== false) {
                    echo $title. ' '.$titleType;
                } else {
                    echo 'Ốp '.$title. ' '.$titleType;
                }

                echo "<br/>";
            }
            echo "<br/>";
            foreach ($skuTypeIphone as $skuType) {
                echo $sku.$skuType;
                echo "<br/>";
            }
            echo "<br/>";
            echo $sku.'.jpg';
            echo "<br/>";
            echo '/storage/product/'.$sku.'.jpg';
            echo "<hr/>";
        }
    }
}
