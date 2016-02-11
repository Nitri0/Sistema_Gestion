<?php namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Mail;
use Auth;

class Helper extends Controller {
	
	public static function Paginador($query , $count_items, $current_page){
		$total 			= count($query);
		$pages 			= ceil($total / $count_items);
		//print_r($query);
		if ($current_page>$pages){
			$current_page = 1;
		}		
		$index_start 	= ($current_page-1) * $count_items; 
		$consulta 		= array_slice($query, $index_start, $count_items);

		$data 			=(object) ["consulta"  		=> $consulta, 
								   "pages" 	 		=> $pages,
								   "current_page" 	=> $current_page,
									 ];
		return $data;
	}

	public static function SendEmail($receptor, $nombreReceptor, $asunto, $plantilla, $parametros, $texto_plano=0){
		if($plantilla == 0){
			$plantilla = ['text' => $texto_plano];
		};
		
		Mail::send($plantilla, $parametros , function($mensaje) use ($receptor, $nombreReceptor, $asunto){
			$mensaje->from(Auth::user()->correo_usuario, Auth::user()->getFullName());
			$mensaje->to($receptor, $nombreReceptor);
			$mensaje->bcc(Auth::user()->correo_usuario);
			$mensaje->subject($asunto);
		});		
	}

	public static function SendEmailLogout($receptor, $nombreReceptor, $asunto, $plantilla, $parametros){
		
		Mail::send($plantilla, $parametros , function($mensaje) use ($receptor, $nombreReceptor, $asunto){
			$mensaje->from(env('FROM_EMAIL'), env('FROM_NAME'));
			$mensaje->to($receptor, $nombreReceptor);
			$mensaje->subject($asunto);
		});		
	}

	public static function sizeFormat($bytes){ 
		$kb = 1024;
		$mb = $kb * 1024;
		$gb = $mb * 1024;
		$tb = $gb * 1024;

		if (($bytes >= 0) && ($bytes < $kb)) {
		return $bytes . ' B';

		} elseif (($bytes >= $kb) && ($bytes < $mb)) {
		return ceil($bytes / $kb) . ' KB';

		} elseif (($bytes >= $mb) && ($bytes < $gb)) {
		return ceil($bytes / $mb) . ' MB';

		} elseif (($bytes >= $gb) && ($bytes < $tb)) {
		return ceil($bytes / $gb) . ' GB';

		} elseif ($bytes >= $tb) {
		return ceil($bytes / $tb) . ' TB';
		} else {
		return $bytes . ' B';
		}
	}


	public static function folderSize($dir){
		$count_size = 0;
		$count = 0;
		$dir_array = scandir($dir);
		  foreach($dir_array as $key=>$filename){
		    if($filename!=".." && $filename!="."){
		       if(is_dir($dir."/".$filename)){
		          $new_foldersize = self::foldersize($dir."/".$filename);
		          $count_size = $count_size+ $new_foldersize;
		        }else if(is_file($dir."/".$filename)){
		          $count_size = $count_size + filesize($dir."/".$filename);
		          $count++;
		        }
		   }
		 }
		return $count_size;
	}
}
