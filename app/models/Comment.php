<?php
/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 01.03.14
 * Time: 12:11
 */
use \HTMLPurifier;
use \HTMLPurifier_Config;
use Ciconia\Ciconia;
class Comment extends Eloquent {
    protected $table = "comments";
    protected $guarded = array();
    public function user(){
        return $this->belongsTo("User");
    }
    public function chart(){
        return $this->belongsTo("Chart");
    }
    public function parsedComment(){
        $content = $this->content;
        $parser = new Ciconia();
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $htmltopurify = $parser->render($content);
        return $purifier->purify($htmltopurify);
    }
} 