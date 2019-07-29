<?php namespace RV\PhpConsole\Models;

use Model;

/**
 * Script Model
 */
class Script extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'rv_phpconsole_scripts';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getJsRunResult(){
        if(!$this->if_run){
            return ' <script>console.log = function(message) {$(\'#result\').append(message);};eval(`'.'console.log('.$this->run_result.')'.'`)</script>';
        }
        return ' <script>console.log = function(message) {$(\'#result\').append(message);};eval(`'.$this->code.'`)</script>';
    }

    public function getPhpRunResult()
    {
        if(!$this->if_run){
            return  '<pre class="prettyprint"><code class="prettyprint">'.$this->run_result.'</code></pre>';
        }
        $code = preg_replace('/^ *(<\?php|<\?)/mi', '', $this->code);
        ob_start();
        eval($code);
        $output= ob_get_clean();
        if(!$this->if_html){
            return $output;
        }
        return '<pre class="prettyprint"><code class="prettyprint">'.$output.'</code></pre>';
    }

}
