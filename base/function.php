<?php defined('APP') OR exit('No direct script access allowed');
/**
 * ************************************
 *  @author : Yudi Purwanto
 *  @link   : http://yudi-purwanto.com
 *  @since  : 14 May 2014
 *  File    : function.php
 *  
 * 
 **************************************/
class _Function
{
	// spaces
	public static function spaces($string) {
	  return (preg_replace('/(\s+)/u',' ',$string));
	
	}
	
	public static function checkEmail( $str ) {
		return preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-\.]+)+[A-z]{2,4}$/", $str);
	}

 	public static function send_mail( $from, $to, $subject, $body ) {
		$headers = '';
		$headers .= "From: $from\n";
		$headers .= "Return-Path: $from\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= "Date: " . date('r', time()) . "\n";
		
	
		mail( $to, $subject , $body, $headers );
	}
	
	//============== linkText
	 	public static function linkText( $text ) { 
	
	    $ret = ' ' . $text; 
	    $ret = preg_replace("#([\t\r\n ])([a-z0-9]+?){1}://([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)#i", '\1<a href="\2://\3" target="_blank">\3</a>', $ret); 
	    $ret = preg_replace("#([\t\r\n ])(www|ftp)\.(([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)#i", '\1<a href="http://\2.\3" target="_blank">\2.\3</a>', $ret); 
	    $ret = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret); 
	    $ret = substr( $ret, 1 ); 
	    return( $ret ); 
	}
	
	public static function checkText( $str ) {
		
		$str = trim( self::spaces( $str ) );
		if( mb_strlen( $str, 'utf8' ) < 1 )
		{
			return false;
		}
		
		$str = nl2br( $str );
		$str = htmlspecialchars ( $str );
		$str = str_replace( array( chr( 10 ), chr( 13 ) ), '' , $str );
		
		// Hashtags and @Mentions
    	$str = preg_replace_callback('~([#@])([^\s#@]+)~',
    	create_function('$m', '$dir = $m[1] == "#" ? "search/?q=%23" : "./";' .
    	'return "<a href=\"$dir$m[2]\">$m[0]</a>";' ),
        $str );
		
		$str = self::linkText( $str );
		
		$str = stripslashes( $str );
		
		return wordwrap( $str, 60, "\n", TRUE );
	}
	
	public static function checkTextDb( $str ) {
		$str = trim( self::spaces( $str ) );
		if( mb_strlen( $str, 'utf8' ) < 1 )
		{
			return false;
		}
		
		$str = nl2br( $str );
		
		$str = str_replace(array(chr(10),chr(13)),'',$str);
				
		return wordwrap( $str, 60, "\n", TRUE );
	}
	
	public static function checkTextMessages( $str ) {
		
		$str = trim( self::spaces( $str ) );
		if( mb_strlen( $str, 'utf8' ) < 1 )
		{
			return false;
		}
		
		$str = nl2br( $str );
		$str = htmlspecialchars ( $str );
		$str = str_replace( array( chr( 10 ), chr( 13 ) ), '' , $str );

		
		
		$str = stripslashes( $str );
		
		return wordwrap( $str, 60, "\n", TRUE );
	}
	
	public static function resizeImage( $image, $width, $height, $scale ) {
		
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			imagefill( $newImage, 0, 0, imagecolorallocate( $newImage, 255, 255, 255 ) );
			imagealphablending( $newImage, TRUE );
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$image); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
    }
	
	chmod($image, 0777);
	return $image;
	}

public static function resizeImageFixed( $image, $width, $height ) {
		
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	$newImage = imagecreatetruecolor($width,$height);
	
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			imagefill( $newImage, 0, 0, imagecolorallocate( $newImage, 255, 255, 255 ) );
			imagealphablending( $newImage, TRUE );
			break;
  	}
	if( $width/$imagewidth > $height/$imageheight ){
        $nw = $width;
        $nh = ($imageheight * $nw) / $imagewidth;
        $px = 0;
        $py = ($height - $nh) / 2;
    } else {
        $nh = $height;
        $nw = ($imagewidth * $nh) / $imageheight;
        $py = 0;
        $px = ($width - $nw) / 2;
    }
	
	imagecopyresampled($newImage,$source,$px, $py, 0, 0, $nw, $nh, $imagewidth, $imageheight);
	
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$image); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
    }
	
		chmod($image, 0777);
		return $image;
	}
	
	public static function getHeight( $image ) {
		$size   = getimagesize( $image );
		$height = $size[1];
		return $height;
	}
	
	public static function getWidth( $image ) {
		$size  = getimagesize( $image);
		$width = $size[0];
		return $width;
	}
	
	//<--- stringRandom
	public static function stringRandom( $long = 16, $chars = '0123456789abcdefghijklmnopqrstuvwxyz!~^#!{}@+*' ) {
    $string = '';
    $max = mb_strlen( $chars ) - 1 ;

    for( $i = 0; $i < $long; ++$i ){
    	
        $string .= mb_substr( $chars, mt_rand( 0, $max ), 1 );
    }
    return $string;
	
	}
	
	//=============== ID HASH
	public static function idHash( $id ) {
		return sha1('~#bae!´+*%=?¿B63~23!~^'.( $id ).microtime().self::stringRandom() );
	}
	
	//=================== cropString
	public static function cropString( $content, $chars ) {
		
	 	return	mb_substr( $content,0, $chars, 'UTF-8' )."..."; 	
	}
	
	
	
	//=================== cropString
	public static function cropStringLimit( $content, $chars ) {
		return	mb_substr( $content,0, $chars, 'UTF-8' ); 
	}
	
	function focusText( $find, $text, $repl = '<strong style="color: #FF7000;">%s</strong>', $ord = 32 ) {
	$find = self::spaces( trim ( $find ) );
    $char = is_numeric( $ord ) ? chr( $ord ) : $ord[0]; // caracter?
    $fn = create_function('$test', 'static $_num = 0, $_tags;
            if (is_numeric($test[1])) return $_tags[$test[1]];
                        $_tags[$_num] = $test[1];
                $tag = "__!{$_num}__";
    ++$_num; return $tag;');

    $text = preg_replace_callback('/((?:<|&lt;|\[).+(?:>|&gt;|\]))/', $fn, $text);

    $found = array();
    $word = explode( $char, $find );

    foreach ( $word as $test )
    { 
        $found []= preg_quote(strip_tags( $test ) );
    }

    $expr = join('|', $found); 
    $text = preg_replace("/($expr)/is", strtr($repl, array('%s' => '\\1')), $text);

    $text = preg_replace_callback('/__!(\d+)__/', $fn, $text);
    return $text;
} 
	
	public static function randomString( $length = 10, $uc = TRUE, $n = TRUE, $sc = FALSE ) {
	    $source = 'abcdefghijklmnopqrstuvwxyz';
	    if( $uc == 1 ) { $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; }
	    if( $n  == 1 ) { $source .= '1234567890'; }
	    if( $sc == 1 ) { $source .= '-_'; }//'|@#~$%()=^*+[]{}-_'; }
	    
	    if( $length > 0 )
	    {
	        $rstr = "";
	        $source = str_split( $source, 1 );
	        for( $i = 1; $i <= $length; ++$i )
	        {
	            mt_srand( (double)microtime() * 1000000 );
	            $num   = mt_rand( 1, count( $source ) );
	            $rstr .= $source[ $num - 1 ];
	        } //<-- * FOR * -->
	    } //<-- * IF * -->
	    return $rstr;
	}
	
    public static function isValidYoutubeURL( $url ) {

	    $parse = parse_url($url);
	    $host  = $parse['host'];
	    if ( !in_array( $host, array( 'youtube.com', 'www.youtube.com' ) ) ) 
	    {
	        return false;
	    }
	
	    $ch = curl_init();
	    $oembedURL = 'www.youtube.com/oembed?url=' . urlencode($url).'&format=json';
	    curl_setopt( $ch, CURLOPT_URL, $oembedURL );
	    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		
		
	    $output = curl_exec( $ch );
	    //unset( $output );
	
	    $info = curl_getinfo( $ch );
	    curl_close( $ch );
	
	    if ( $info['http_code'] !== 404 )
		{
			return json_decode( $output );
		}
	    else
		{
			return false;
		}
	} //<-------- FUNCTION END
	
	public static function isValidVimeoURL( $url ) {

	    $parse = parse_url($url);
	    $host  = $parse['host'];
	    if ( !in_array( $host, array( 'vimeo.com' ) ) ) 
	    {
	        return false;
	    }
	
	    $ch = curl_init();
	    $oembedURL = 'vimeo.com/api/oembed.json?url=' . urlencode( $url );
	    curl_setopt( $ch, CURLOPT_URL, $oembedURL );
	    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		
		
	    $output = curl_exec( $ch );
	    //unset( $output );
	
	    $info = curl_getinfo( $ch );
	    curl_close( $ch );
	
	    if ( $info['http_code'] !== 404 )
		{
			return json_decode( $output );
		}
	    else
		{
			return false;
		}
	} //<-------- FUNCTION END	
	
	public static function getYoutubeId( $url ) {
	 $pattern = 
	     '%^# Match any youtube URL
	    (?:https?://)? 
	    (?:www\.)?     
	    (?:             
	      youtu\.be/    
	    | youtube\.com  
	      (?:           
	        /embed/    
	      | /v/         
	      | .*v=        
	      )            
	    )              
	    ([\w-]{10,12})  
	    ($|&).*         
	    $%x'
	    ;
	        ;
	    $result = preg_match( $pattern, $url, $matches );
	    if ( false !== $result ) {
	        return $matches[1];
	    }
	    return false;
	}//<<<-- End
	
	public static function formatNumber( $number ) {
    if( $number >= 1000 &&  $number < 1000000 ) {
       	
       return number_format( $number/1000, 1 ). "k";
    }
	else if( $number >= 1000000 )
	{
		return number_format( $number/1000000, 1 ). "m"; 
	}
    else {
        return $number;
    }
   } //<<<<--- End Function
   
   public static function convertAscii( $entry ) {
		 $changes = array(
		'!' => '%21',
		'"' => '%22',
		'#' => '%23',
		'$' => '%24',
		'&' => '%26',
		"'" => '%27',
		'(' => '%28',
		')' => '%29',
		'*' => '%2A',
		'+' => '%2B',
		'-' => '%2D',
		'`' => '%60',
		'@' => '%40',
		'<' => '%3C',
		'=' => '3D',
		'>' => '3E',
		'?' => '3F',
		'^' => '5E'
		);
		
		$output = strtr( $entry , $changes );
		return $output;
	} //<<<<---- * End * ---->>>>
} //<------------------- * END CLASS * ----------->

/* End of file function.php */
/* Location: ./base/function.php */