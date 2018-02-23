<?php

//

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileManagerController extends Controller {

    public function index() {

        return view('admin.filemanager.index');
    }

    public function connector() {

        
// run elFinder
        $connector = new \elFinderConnector(new \elFinder([
            'roots' => [
                
                [
                   'driver' => 'LocalFileSystem',
                   'path' => public_path('/storage/filemanager'),
                   'URL' => url('/storage/filemanager'),
                   'uploadDeny' => array('all'), // Recomend the same settings as the original volume that uses the trash
                   'uploadAllow' => array('image', 'text/plain', 'application/pdf'), // Same as above
                   'uploadOrder' => array('deny', 'allow'), // Same as above
                   'accessControl' => function($attr, $path, $data, $volume, $isDir, $relpath) {
                        $basename = basename($path);
                        return $basename[0] === '.'                  // if file/folder begins with '.' (dot)
                                && strlen($relpath) !== 1           // but with out volume root
                                ? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
                                : null;                                 // else elFinder decide it itself
                    }
                ]
            ]
        ]));
        $connector->run();
    }
    
     public function popup() {

        return view('admin.filemanager.popup');
    }

}
