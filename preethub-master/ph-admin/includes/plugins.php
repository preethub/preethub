<?php
function get_plugin_data($plugin_file) {
    $plugin_data = @file_get_contents($plugin_file);
    if ($plugin_data === false) return [];
    $get = function($pattern) use ($plugin_data) {
        return preg_match($pattern, $plugin_data, $m) ? trim($m[1]) : '';
    };
    $name=$get('/Plugin Name:(.*)$/mi');
    if($name==='') return [];
    $uri=$get('/Plugin URI:(.*)$/mi');
    $desc=$get('/Description:(.*)$/mi');
    $author=$get('/Author:(.*)$/mi');
    $author_uri=$get('/Author URI:(.*)$/mi');
    $version=$get('/Version:(.*)$/mi');
    return ['Name'=>$name,'Title'=>$name,'Description'=>$desc,'Author'=>$author,'Version'=>$version,'URI'=>$uri,'AuthorURI'=>$author_uri];
}
function get_plugins() {
    $plugins=[];$plugin_files=[];
    $dir=PH_PATH.PLUGINS_PATH;
    if(!is_dir($dir)) return $plugins;
    $iterator=new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir,FilesystemIterator::SKIP_DOTS));
    foreach($iterator as $file){
        if($file->isFile() && strtolower($file->getExtension())==='php'){
            $relative=str_replace('\\','/',substr($file->getPathname(),strlen($dir)+1));
            $plugin_files[]=$relative;
        }
    }
    sort($plugin_files);
    foreach($plugin_files as $plugin_file){
        $data=get_plugin_data($dir.'/'.$plugin_file);
        if($data) $plugins[$plugin_file]=$data;
    }
    return $plugins;
}
